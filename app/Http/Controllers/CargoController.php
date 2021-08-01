<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoController extends Controller
{
    public function index()
    {
        $cargos = Cargo::all();

        return view('cargos.index', ["cargos" => $cargos]);
    }

    public function create(Request $request)
    {
        $request->validate(['name' =>'required', 'salary' =>'required']);

        if (Cargo::where('name', $request->name)->exists()) {
            return redirect()->route('cargos.index')
                ->with([
                    'error' => 'El tipo de cargo ingresado no esta disponible',
            ]);
        }

        $cargo = new Cargo;
        $cargo->name = $request->name;
        $cargo->salary = $request->salary;
        $cargo->save();

        return redirect()->route('cargos.index')
            ->with([
                'success' => 'Un nuevo cargo fue agregado con exito',
        ]);
    }

    public function delete(Request $request)
    {
        $cargo = Cargo::find($request->id);
        $cargo->delete();

        return redirect()->route('cargos.index')
            ->with([
                'success' => 'El tipo de cargo seleccionado fue eliminado con exito',
        ]);
    }

    public function edit(Request $request)
    {
        $cargo = Cargo::find($request->id);

        if ($cargo->name) {
            if ($cargo->name != $request->name) {
                if (Cargo::where('name', $request->name)->exists()) {
                    return redirect()->route('cargos.index')
                        ->with([
                            'error' => 'El tipo de cargo ingresado no esta disponible',
                    ]);
                }
            }
        }

        $request->validate(['name' =>'required', 'salary' =>'required']);
        $cargo->name = $request->name;
        $cargo->salary = $request->salary;
        $cargo->save();

        return redirect()->route('cargos.index')
            ->with([
                'info' => 'El tipo de cargo seleccionado fue actualizado con exito',
        ]);
    }
}

