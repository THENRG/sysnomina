<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignacion;
use App\Models\Deduccion;
use App\Models\Departamento;
use App\Models\Employee;
use App\Models\Nomina;
use App\Models\PreNomina;
use App\Models\Reporte;
use App\Models\Asistencia;
use App\Models\Cargo;
use Carbon\Carbon;
use DB;
use Session;
use DateTime;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NominaController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('modulo', 'nomina');
        $request->session()->put('userName', User::find(Auth::id())->name);

        $empleados = Employee::count();
        $departamentos = Departamento::count();
        $asistencias = Asistencia::count();

        $data = [
            'departamentos' => $departamentos,
            'empleados' => $empleados,
            'asistencias' => $this->getAsistenciasHoy(),
            'a_tiempo' => $this->getAsistenciaTipo("a tiempo"),
            'tarde_hoy' => $this->getAsistenciaTipo("tarde"),
            'rep_prenom' => $this->getPreNominaCount(),
        ];

        return view('nomina.index', $data);
    }

    public function getAsistenciasHoy() {
        $n = 0;
        $date = Carbon::now();
        $hoy = $date->toFormattedDateString();
        $asistencias = Asistencia::all();

        foreach ($asistencias as $asistencia) {
            if ($asistencia->date == $hoy) {
                $n = $n + 1;
            }
        }

        return $n;
    }

    public function getPreNominaCount() {
        $n = 0;
        $reportes = Reporte::all();

        foreach ($reportes as $reporte) {
            if ($reporte->type == "prenomina") {
                $n = $n + 1;
            }
        }

        return $n;
    }

    public function getAsistenciaTipo($type) {
        $n = 0;
        $date = Carbon::now();
        $hoy = $date->toFormattedDateString();
        $asistencias = Asistencia::all();

        foreach ($asistencias as $asistencia) {
            if ($asistencia->date == $hoy) {
                $employee = Employee::where("name", $asistencia->employee)->first();
                if ($employee) {
                    $hr = explode(" - ", $employee->horario);
                    $diffe = strtotime($hr[0]) - strtotime($asistencia->hour_in);
                    $diff_in_min = $diffe/3600;               

                    if ($type == "tarde") {
                        if (round($diff_in_min)  < 0) {
                            $n = $n + 1;
                        }
                    }elseif ($type == "a tiempo"){
                        if (round($diff_in_min)  >= 0) {
                            $n = $n + 1;
                        }
                    }
                }
            }
        }

        return $n;
    }

    public function getNominasEmployee($employees) {
        $list = [];
        $prenominas = app(PreNominaController::class)->getPreNominasEmployee($employees);

        foreach ($employees as $employee) {
            $query = Nomina::where('employee', $employee->id)->first();
            if ($query) {
                $list[$employee->id] = $query;              
            }
        }
        
        foreach ($prenominas as $employee => $value) {
            if (!isset($list[$employee])) {
                $list[$employee] = [];  
            }

            foreach ($value as $key => $count) {
                $list[$employee][$key] = [$count, 0]; 
            } 
        }        
   
        return $list;
    }

    public function getEmployeeNominaData($id) {
        $query = Nomina::where('employee', $id)->first();
        return $query->info;
    }    

    public function getEmployeesSalarioDiario($employees) {
        $t = [];

        foreach ($employees as $empleado) {
            $t[$empleado->name] = $empleado->getSalario() / 30;
        }

        return $t;
    }

    public function load()
    {
        $empleados = Employee::all();
        $asignaciones = Asignacion::all();
        $deducciones = Deduccion::all();
        $nominas = $this->getNominasEmployee($empleados);
        $salarios = $this->getEmployeesSalarioDiario($empleados);
        
        $data = [
            'empleados' => $empleados,
            'asignaciones' => $asignaciones,
            'deducciones' => $deducciones,
            'nominas' => $nominas,
            'salarios' => $salarios,
        ];

        return view('nomina.load', $data);
    }

    public function open(Request $request)
    {
        $request->session()->put('from_to', $request->daterange_nom);

        $empleados = Employee::all();
        $asignaciones = Asignacion::all();
        $deducciones = Deduccion::all();
        $nominas = $this->getNominasEmployee($empleados);

        $data = [
            'empleados' => $empleados,
            'asignaciones' => $asignaciones,
            'deducciones' => $deducciones,
            'nominas' => $nominas,
        ];

        return view('nomina.load', $data);
    }

    public function store(Request $request)
    {
        $list = [];
        $asignaciones = Asignacion::all();
        $asignaciones_sumatoria = 0;
        foreach ($asignaciones as $key => $descripcion) {
            $input_name = str_replace(' ', '_', $descripcion->name);
            $input_value = $request->get($input_name);
            $input_amount = $request->get($input_name.':amount');    
            $list[$descripcion->name] = [$input_value, $input_amount];

            if (!is_null($input_amount)) {
                $asignaciones_sumatoria = $asignaciones_sumatoria + $input_amount;
            }
        }
        $deducciones = Deduccion::all();
        $deducciones_sumatoria = 0;
        foreach ($deducciones as $key => $descripcion) {
            $input_name = str_replace(' ', '_', $descripcion->name);
            $input_value = $request->get($input_name); 
            $input_amount = $request->get($input_name.':amount');       
            $list[$descripcion->name] = [$input_value, $input_amount];

            if (!is_null($input_amount)) {
                $deducciones_sumatoria = $deducciones_sumatoria + $input_amount;
            }
        }

        $employee_id = $request->id;
        $query = Nomina::where('employee', $employee_id)->first();
        if ($query) {
            $nomina = Nomina::find($query->id);
        } else{
            $nomina = new Nomina;
        }

        $daterange = session()->get('from_to');

        $dates = explode(" - ", $daterange);
        $from = explode("/", $dates[0]);
        $to = explode("/", $dates[1]);
               
        $date1 = new DateTime($from[2].'-'.$from[1].'-'. $from[0]);
        $date2 = new DateTime($to[2].'-'.$to[1].'-'. $to[0]);
        $diff = $date1->diff($date2);

        $empleado = Employee::find($employee_id);
        $salario_diario = $empleado->getSalario() / 30;
        $gross = $salario_diario * $diff->days;
        $total_deduction = $deducciones_sumatoria + $asignaciones_sumatoria;
        $net = $gross - $total_deduction;

        $nomina->dates = $request->from_to;
        $nomina->employee = $employee_id;
        $nomina->total_asignaciones = $asignaciones_sumatoria;
        $nomina->total_deducciones = $deducciones_sumatoria;
        $nomina->info = $list;
        $nomina->neto = $net;
        $nomina->save();



        $empleados = Employee::all();
        $asignaciones = Asignacion::all();
        $deducciones = Deduccion::all();
        $nominas = $this->getNominasEmployee($empleados);
        $data = [
            'empleados' => $empleados,
            'asignaciones' => $asignaciones,
            'deducciones' => $deducciones,
            'nominas' => $nominas,
            'success' => 'Los detalles del empleado fueron cargados con éxito',            
        ];

        return redirect()->route('nomina.load')->with($data);
    }

    public function process(Request $request)
    {
        $nomina_data = [];
        $nominas = Nomina::all();
        $n = 0;
        foreach ($nominas as $nom) {
            $nomina_data[$n] = $nom;
            $n = $n + 1;
        }

        $registries = PreNomina::all();
        foreach ($registries as $registry) {
            $registry->delete();
        }

        $registries = Nomina::all();
        foreach ($registries as $registry) {
            $registry->delete();
        }

        $reporte = new Reporte;
        $reporte->dates = session()->get('from_to');
        $reporte->type = "nomina";
        $reporte->description = "REPORTE DE NOMINA";
        $reporte->responsable = session()->get('userName');
        $reporte->data = $nomina_data;
        $reporte->save();
        $request->session()->forget('from_to');
        $report = Reporte::where("dates", session()->get('from_to'))->first();

        $empleados = Employee::all();
        $asignaciones = Asignacion::all();
        $deducciones = Deduccion::all();
        $nominas = $this->getNominasEmployee($empleados);
        $data = [
            'empleados' => $empleados,
            'asignaciones' => $asignaciones,
            'deducciones' => $deducciones,
            'nominas' => $nominas,
            'success' => 'La nómina de empleados fue procesada con éxito.',            
        ];

        return redirect()->route('nomina.load')->with($data);
    }
}
