<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Employee;
use App\Models\Departamento;
use Carbon\Carbon; 

class AsistenciaController extends Controller
{
    public function index()
    {
        return view("asistencias.index", [
            "asistencias" => $this->getAsistencias(),
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'employee' =>'required','hr_in' =>'required',
        ]);

        $date = Carbon::now();
        $employee = Employee::where('cedula', $request->employee)->first();

        if ($employee) {
            if (session()->get('modulo') == "prenomina") {
                $dpto = Departamento::find(session()->get('dpto'));

                if ($employee->dpto != $dpto->name) {
                    return redirect("asistencias")->with(['error' => 'Este empleado no pertenece a esta unidad']);
                }
            }

            $asistencia = Asistencia::where("employee", $employee->name)->first();
            if ($asistencia) {
                if ($asistencia->date == $date->toFormattedDateString()) {
                    return redirect("asistencias")->with(['error' => 'La asistencia del empleado ya se encuentra registrada']);
                }
            }

            $hr = explode(" - ", $employee->horario);
            $diffe = strtotime($hr[0]) - strtotime($request->hr_in);
            $diff_in_min = $diffe/3600;               
            $status = "";

            if (round($diff_in_min) < 0) {
                $status = "tarde"; 
            }else {
                $status = "a tiempo";
            }

            $asistencia = new Asistencia;
            $asistencia->date = $date->toFormattedDateString();
            $asistencia->cedula = $employee->cedula;
            $asistencia->employee = $employee->name;
            $asistencia->hour_in = $request->hr_in;
            $asistencia->status = $status;
            $asistencia->save();

            return redirect()->route('asistencias.index')
                ->with([
                    'success' => 'Se ha registrado la asistencia del empleado con exito',
            ]);
        }else{
            return redirect("asistencias")->with(['error' => 'No se ha encontrado un empleado con esta cedula']);            
        }
    }

    public function getAsistencias() {
        if (session()->has('dpto')) {
            $data = [];
            $date = Carbon::now();
            $hoy = $date->toFormattedDateString();
            $asistencias = Asistencia::all();

            foreach ($asistencias as $key => $asistencia) {
                $employee = Employee::where("name", $asistencia->employee)->first();

                if ($employee && $employee->dpto == session()->has('dpto')) {
                    $dpto = Departamento::find(session()->get('dpto'));

                    if ($employee->dpto == $dpto->name) {
                        if ($asistencia->date == $hoy) {
                            $data[$key] = $asistencia;
                        }
                    }
                }
            }

            return $data;
        }else{
            return Asistencia::all();
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'hr_out' =>'required',
        ]);

        $asistencia = Asistencia::find($request->id);
        $asistencia->hour_out = $request->hr_out;
        $asistencia->save();

        return redirect()->route('asistencias.index')
            ->with([
                'success' => 'Se ha registrado la hora de salida con exito',
        ]);
    }
}