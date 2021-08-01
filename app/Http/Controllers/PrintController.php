<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Reporte;
use App\Models\Employee;
use App\Models\Asignacion;
use App\Models\Deduccion;
use App\Models\Departamento;

class PrintController extends Controller
{
    public function shownominapdf($id){
        $reporte = Reporte::find($id);
        $dates = explode(" - ", $reporte->dates);

        $employees = Employee::all();
        $EmployeeCode = [];
        foreach ($employees as $employee) {
            if ($employee->id > 9) {
                $EmployeeCode[$employee->name] = '00' . $employee->id;
            }elseif ($employee->id > 99) {
                $EmployeeCode[$employee->name] = '0' . $employee->id;
            }else {
                $EmployeeCode[$employee->name] = '000' . $employee->id;
            }
        }

        $validate = [];
        $asignaciones = Asignacion::all();
        foreach ($asignaciones as $description) {
            $validate[$description->name] = true;
        }

        $content = [];

        foreach ($reporte->data as $key => $value) {
            $employee = Employee::find($value["employee"]);

            if ($value["info"]) {
                $content[$employee->name] = [
                    "asignaciones" => $value["total_asignaciones"],
                    "deducciones" => $value["total_deducciones"],
                    "neto" => $value["neto"],
                    "info" => $value["info"],
                    "cargo" => $employee->cargo,
                    "cedula" => $employee->cedula,
                    "salario" => $employee->getSalario() / 30,
                ];
            }
        }

        $data = [
            'id' => $reporte->id,
            'responsable' => $reporte->responsable,
            'title' => $reporte->description,
            'from' => $dates[0],
            'to' => $dates[1],
            'content' => $content,
            'validate' => $validate,
            'EmployeeCode' => $EmployeeCode,
        ];

        return PDF::loadView('pdf.nomina-pdf', $data)->setPaper('a4', 'landscape')->stream('archivo.pdf');
   
        /*
        return view('pdf.nomina-pdf', $data);
        */
    }

    public function showpdf($id){

        $reporte = Reporte::find($id);
        $content = [];
        $DPTO = "N/A";

        foreach ($reporte->data as $key => $value) {
            if ($value["info"]) {
                $department = Departamento::find($value["dpto"]);
                $DPTO = $department->name;
                foreach ($value["info"] as $employee => $conceptos) {
                    $employee = Employee::find($employee);
                    $content[$employee->name] = $conceptos;
                }
            }
        }

        $IDs = [];
        $Names = [];
        $asignaciones = Asignacion::all();
        foreach ($asignaciones as $value) {
            $IDs[$value->name] = $this->initials($value->name);
            $Names[ $IDs[$value->name] ] = $value->name;
        }
        $deducciones = Deduccion::all();
        foreach ($deducciones as $value) {
            $IDs[$value->name] = $this->initials($value->name);
            $Names[ $IDs[$value->name] ] = $value->name;
        }

        $employees = Employee::all();
        $EmployeeCode = [];
        foreach ($employees as $employee) {
            if ($employee->id > 9) {
                $EmployeeCode[$employee->name] = '00' . $employee->id;
            }elseif ($employee->id > 99) {
                $EmployeeCode[$employee->name] = '0' . $employee->id;
            }else {
                $EmployeeCode[$employee->name] = '000' . $employee->id;
            }
        }

        $dates = explode(" - ", $reporte->dates);

        $data = [
            'id' => $reporte->id,
            'responsable' => $reporte->responsable,
            'title' => $reporte->description,
            'from' => $dates[0],
            'to' => $dates[1],
            'content' => $content,
            'IDs' => $IDs,
            'Names' => $Names,
            'EmployeeCode' => $EmployeeCode,
            'DPTO' => $DPTO,
        ];

        return PDF::loadView('pdf.prenomina-pdf', $data)->setPaper('a4', 'landscape')->stream('archivo.pdf');
   
        /*
        return view('pdf.prenomina-pdf', $data);
        */
    }

    function initials($str) {
        $ret = '';
        foreach (explode(' ', $str) as $Word)
            $ret .= strtoupper($Word[0]);
        return $ret;
    }
}