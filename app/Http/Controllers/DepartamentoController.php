<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Employee;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::all();
        $empleados = Employee::all();
        $dpto_employees = [];

        foreach ($departamentos as $key => $value) {
            $dpto_employees[$value->name] = 0;
        }

        foreach ($empleados as $key => $value) {
            if (isset($dpto_employees[$value->dpto])) {
                $dpto_employees[$value->dpto] = $dpto_employees[$value->dpto] + 1;
            }
        }

        return view('departamentos.index', [
            "departamentos" => $departamentos,
            "dpto_employees" => $dpto_employees,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate(['name' =>'required']);

        if (Departamento::where('name', $request->name)->exists()) {
            return redirect()->route('departamentos.index')
                ->with([
                    'error' => 'El nombre de la unidad ingresada ya se encuentra registrado',
            ]);
        }

        $departamento = new Departamento;
        $departamento->name = $request->name;
        $departamento->save();

        return redirect()->route('departamentos.index')
            ->with([
                'success' => 'Se ha creado una nueva unidad con exito',
        ]);
    }

    public function delete(Request $request)
    {
        $departamento = Departamento::find($request->id);
        $departamento->delete();

        return redirect()->route('departamentos.index')
            ->with([
                'success' => 'La unidad o departamento fue eliminado con exito',
        ]);
    }

    public function edit(Request $request)
    {
        if (Departamento::where('name', $request->name)->exists()) {
            return redirect()->route('departamentos.index')
                ->with([
                    'error' => 'El nombre de la unidad ingresada ya se encuentra registrado',
            ]);
        }

        $request->validate(['name' =>'required']);
        $departamento = Departamento::find($request->id);

        $query = Employee::select('id', 'dpto')->get();
        if ($query) {
            foreach ($query as $value) {
                if ($value->dpto == $departamento->name) {
                    $employee = Employee::find($value->id);
                    $employee->dpto = $request->name;
                    $employee->save();
                }
            }
        }

        $departamento->name = $request->name;
        $departamento->save();

        return redirect()->route('departamentos.index')
            ->with([
                'info' => 'La unidad/departamento seleccionado fue actualizado con exito',
        ]);
    }
}
