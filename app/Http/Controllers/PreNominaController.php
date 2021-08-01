<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignacion;
use App\Models\Deduccion;
use App\Models\Departamento;
use App\Models\Employee;
use App\Models\PreNomina;
use App\Models\Reporte;
use App\Models\Asistencia;
use Carbon\Carbon;
use DB;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PreNominaController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('modulo', 'prenomina');
        $request->session()->put('userName', User::find(Auth::id())->name);

        $data = [
            'departamentos' => Departamento::all(),
        ];

        return view('prenomina.index', $data);
    }

    public function show(Request $request, $id)
    {
        $request->session()->put('dpto', $id);

        $department = Departamento::find($id);
        $count_employees = count($department->getEmployees());

        $data = [
            'id' => $id,
            'current_dpto' => $department,
            'departamentos' => Departamento::all(),
            'asistencias' => $this->getDptoAsistenciasHoy(),
            'a_tiempo' => $this->getDptoAsistenciaTipo("a tiempo"),
            'tarde_hoy' => $this->getDptoAsistenciaTipo("tarde"),
            'empleados' => $count_employees,
        ];

        return view('prenomina.index', $data);
    }

    public function getDptoAsistenciasHoy() {
        $n = 0;
        $date = Carbon::now();
        $hoy = $date->toFormattedDateString();
        $asistencias = Asistencia::all();

        foreach ($asistencias as $asistencia) {
            $employee = Employee::where("name", $asistencia->employee)->first();
            if ($employee) {
                $dpto = Departamento::find(session()->get('dpto'));
                if ($employee->dpto == $dpto->name) {
                    if ($asistencia->date == $hoy) {
                        $n = $n + 1;
                    }
                }
            }
        }

        return $n;
    }

    public function getDptoAsistencias() {
        $data = [];
        $asistencias = Asistencia::all();

        foreach ($asistencias as $key => $asistencia) {
            $employee = Employee::where("name", $asistencia->employee)->first();
            $dpto = Departamento::find(session()->get('dpto'));

            if ($employee && $employee->dpto == $dpto->name) {
                $data[$key] = $asistencia;
            }
        }

        return $data;
    }

    public function getDptoAsistenciaTipo($type) {
        $n = 0;
        $date = Carbon::now();
        $hoy = $date->toFormattedDateString();
        $asistencias = Asistencia::all();

        foreach ($asistencias as $asistencia) {
            if ($asistencia->date == $hoy) {
                $employee = Employee::where("name", $asistencia->employee)->first();
                if ($employee) {
                    $dpto = Departamento::find(session()->get('dpto'));
                    if ($employee->dpto == $dpto->name) {
                        $hr = explode(" - ", $employee->horario);
                        $diffe = strtotime($hr[0]) - strtotime($asistencia->hour_in);
                        $diff_in_min = $diffe/3600;               

                        if ($type == "tarde") {
                            if (round($diff_in_min) < 0) {
                                $n = $n + 1;
                            }
                        }else {
                            if (round($diff_in_min) >= 0) {
                                $n = $n + 1;
                            }
                        }
                    }
                }
            }
        }

        return $n;
    }

    public function load($id)
    {
        $department = Departamento::find($id);
        $empleados = $this->getEmployeesFromDepartment($department);
        $asignaciones = Asignacion::all();
        $deducciones = Deduccion::all();
        $prenominas = $this->getPreNominasEmployee($empleados);

        $data = [
            'empleados' => $empleados,
            'asignaciones' => $asignaciones,
            'deducciones' => $deducciones,
            'prenominas' => $prenominas,
            'id' => $id,
        ];

        return view('prenomina.load', $data);
    }

    public function getPreNominasEmployee($employees) {
        $list = [];

        foreach ($employees as $employee) {
            $query_dpto = Departamento::where('name', $employee->dpto)->first();
            $query = PreNomina::where('dpto', $query_dpto->id)->first();

            if ($query) {
                if (isset($query->info[$employee->id])) {
                    $list[$employee->id] = $query->info[$employee->id];
                }
            }
        }

        return $list;
    }

    public function getEmployeesFromDepartment($dpto)
    {
        if ($dpto) {
            $empleados = Employee::all();
            $employees = [];

            foreach ($empleados as $key => $empleado) {
                if ($empleado->dpto == $dpto->name) {
                    $employees[$key] = $empleado;
                }
            }

            return $employees;
        }
    }

     public function countDepartmentEmployees($dpto)
    {
        if ($dpto) {
            $count = 0;

            $empleados = Employee::all();
            $employees = [];

            foreach ($empleados as $key => $empleado) {
                if ($empleado->dpto == $dpto->name) {
                    $count = $count + 1;
                }
            }

            return $count;
        }

    }   

    public function store(Request $request, $id)
    {
        $asignaciones = Asignacion::all();
        $deducciones = Deduccion::all();
        $department = Departamento::find($id);

        $list = [];
        foreach ($asignaciones as $key => $descripcion) {
            $input_name = str_replace(' ', '_', $descripcion->name);
            $input_value = $request->get($input_name);     
            $list[$descripcion->name] = $input_value;
        }
        foreach ($deducciones as $key => $descripcion) {
            $input_name = str_replace(' ', '_', $descripcion->name);
            $input_value = $request->get($input_name);     
            $list[$descripcion->name] = $input_value;
        }

        $dpto_data = [];
        $query = PreNomina::where('dpto', $id)->first();
        if ($query) {
            $dpto_data = $query->info;
        } else{
            $dpto_data[$request->id] = []; 
        }

        foreach ($list as $key => $value) {
            $dpto_data[$request->id][$key] = $value;
        }

        $reporte = PreNomina::find($query->id);
        $reporte->dates = session()->get('from_to');;
        $reporte->info = $dpto_data;
        $reporte->save();

        $department = Departamento::find($id);
        $empleados = $this->getEmployeesFromDepartment($department);
        $asignaciones = Asignacion::all();
        $deducciones = Deduccion::all();
        $prenominas = $this->getPreNominasEmployee($empleados);

        $data = [
            'empleados' => $empleados,
            'asignaciones' => $asignaciones,
            'deducciones' => $deducciones,
            'prenominas' => $prenominas,
            'id' => $id,
            'success' => 'Los detalles del empleado fueron cargados con éxito',            
        ];

        return redirect()->route('prenomina.load', ['id' => $id])->with($data);
    }

    public function process(Request $request, $id)
    {
        $prenomina_data = [];
        $prenominas = PreNomina::all();
        $n = 0;
        foreach ($prenominas as $prenom) {
            $prenomina_data[$n] = $prenom;
            $n = $n + 1;
        }

        $reporte = new Reporte;
        $reporte->dates = session()->get('from_to');
        $reporte->type = "prenomina";
        $reporte->description = "REPORTE DE PRE-NOMINA";
        $reporte->responsable = session()->get('userName');
        $reporte->data = $prenomina_data;
        $reporte->save();
        $request->session()->forget('from_to');


        $department = Departamento::find($id);
        $empleados = $this->getEmployeesFromDepartment($department);
        $asignaciones = Asignacion::all();
        $deducciones = Deduccion::all();
        $prenominas = $this->getPreNominasEmployee($empleados);

        $data = [
            'empleados' => $empleados,
            'asignaciones' => $asignaciones,
            'deducciones' => $deducciones,
            'prenominas' => $prenominas,
            'id' => $id,
            'success' => 'El registro de la Pre Nomina fue procesado con éxito',
        ];

        return redirect()->route('prenomina.load', ['id' => $id])->with($data);       
    }

    public function open(Request $request, $id)
    {
        $request->session()->put('from_to', $request->daterange);

        $query = PreNomina::where('dpto', $id)->first();
        if ($query) {
            $registro = PreNomina::find($query->id);
        } else{
            $registro = new PreNomina;
        }

        $registro->dpto = $id;
        $registro->dates = $request->daterange;
        $registro->save();


        $department = Departamento::find($id);
        $empleados = $this->getEmployeesFromDepartment($department);
        $asignaciones = Asignacion::all();
        $deducciones = Deduccion::all();
        $prenominas = $this->getPreNominasEmployee($empleados);

        $data = [
            'empleados' => $empleados,
            'asignaciones' => $asignaciones,
            'deducciones' => $deducciones,
            'prenominas' => $prenominas,
            'id' => $id,
        ];

        return view('prenomina.load', $data);
    }
}
