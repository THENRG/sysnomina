<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reporte;
use App\Models\Employee;
use DB;

class ReporteController extends Controller
{
    public function index()
    {
        $empleados = Employee::all();
        $reportes = Reporte::all();

        return view('reportes.index', [
            "empleados" => $empleados, 
            "reportes" => $reportes, 
        ]);
    }
}
