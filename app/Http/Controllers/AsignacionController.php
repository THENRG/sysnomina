<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignacion;

class AsignacionController extends Controller
{
    public function index()
    {
    	$asignaciones = Asignacion::all();

        return view('asignaciones.index', ["asignaciones" => $asignaciones]);
    }

    public function create(Request $request)
    {
        $request->validate([
			'name' =>'required'
		]);

		if (Asignacion::where('name', $request->name)->exists()) {
			return redirect()->route('asignaciones.index')
            ->with([
                'error' => 'El concepto de asignación ya se encuentra registrado',
            ]);
		}

        $asignacion = new Asignacion;
        $asignacion->name = $request->name;
        $asignacion->save();

        return redirect()->route('asignaciones.index')
            ->with([
                'success' => 'El concepto de asignación fue agregado con exito',
        ]);
    }

    public function delete(Request $request)
    {
        $asignacion = Asignacion::find($request->name);
        $asignacion->delete();

        return redirect()->route('asignaciones.index')
            ->with([
                'success' => 'El concepto de asignación fue eliminado con exito',
        ]);
    }

    public function edit(Request $request)
    {
		if (Asignacion::where('name', $request->name)->exists()) {
            return redirect()->route('asignaciones.index')
            ->with([
                'error' => 'El nuevo concepto de asignación ya se encuentra registrado',
            ]);
		}

		$request->validate([
			'name' =>'required'
		]);

		$asignacion = Asignacion::find($request->id);
		$asignacion->name = $request->name;
		$asignacion->save();

        return redirect()->route('asignaciones.index')
            ->with([
                'info' => 'El concepto de asignación fue actualizado con exito',
        ]);
    }
}

