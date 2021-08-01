<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Cargo;
use App\Models\Departamento;
use App\Models\Horario;
use App\Models\User;

class EmployeeController extends Controller
{
    public function index()
    {
        $empleados = Employee::all();
        $cargos = Cargo::all();
        $horarios = Horario::all();
        $departamentos = Departamento::all();

        return view('empleados.index', [
            "empleados" => $empleados, 
            "cargos" => $cargos, 
            "horarios" => $horarios, 
            "departamentos" => $departamentos
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'cedula' =>'required',
            'name' =>'required', 
            'email' =>'required', 
            'genero' =>'required', 
            'contacto' =>'required', 
            'profesion' =>'required', 
            'fecha_nacimiento' =>'required', 
            'direccion' =>'required', 
            'rif' =>'required',  
            'cargo' =>'required',
            'dpto' =>'required'
        ]);

        if (Employee::where('cedula', $request->cedula)->exists()) {
            return redirect("empleados")->withErrors('Cedula de identidad no disponible. Nº '.$request->cedula);
        }

        $empleado = new Employee;
        $empleado->name = $request->name;
        $empleado->cedula = $request->cedula;
        $empleado->email = $request->email;
        $empleado->genero = $request->genero;
        $empleado->contacto = $request->contacto;
        $empleado->profesion = $request->profesion;
        $empleado->fecha_nacimiento = $request->fecha_nacimiento;
        $empleado->direccion = $request->direccion;
        $empleado->rif = $request->rif;
        $empleado->cargo = $request->cargo;
        $empleado->dpto = $request->dpto;
        $empleado->horario = $request->horario;
        $empleado->save();

        return redirect("empleados")->withSuccess('Un nuevo empleado ha sido agregado con exito');  
    }

    public function edit(Request $request)
    {
        $request->validate([
            'id' =>'required',
            'name' =>'required', 
            'email' =>'required', 
            'genero' =>'required', 
            'contacto' =>'required', 
            'profesion' =>'required', 
            'fecha_nacimiento' =>'required', 
            'direccion' =>'required', 
            'rif' =>'required',  
            'cargo' =>'required',
            'dpto' =>'required'
        ]);

        $empleado = Employee::find($request->id);

        $empleado->name = $request->name;
        $empleado->email = $request->email;
        $empleado->genero = $request->genero;
        $empleado->contacto = $request->contacto;
        $empleado->profesion = $request->profesion;
        $empleado->fecha_nacimiento = $request->fecha_nacimiento;
        $empleado->direccion = $request->direccion;
        $empleado->rif = $request->rif;
        $empleado->cargo = $request->cargo;
        $empleado->dpto = $request->dpto;
        $empleado->horario = $request->horario;
        $empleado->cedula = $request->cedula;
        $empleado->save();

        return redirect("empleados")->withSuccess('La informacion del empleado fue actualizada con exito');
    }

    public function delete(Request $request)
    {
        $empleado = Employee::find($request->id);
        $empleado->delete();

        return redirect("empleados")->withSuccess('El empleado seleccionado fue eliminado con exito');
    }
}