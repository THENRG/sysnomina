<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deduccion;

class DeduccionController extends Controller
{
    public function index()
    {
        $deducciones = Deduccion::all();

        return view('deducciones.index', ["deducciones" => $deducciones]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' =>'required'
        ]);

        if (Deduccion::where('name', $request->name)->exists()) {
            return redirect()->route('deducciones.index')
            ->with([
                'error' => 'El concepto de deducción ya se encuentra registrado',
            ]);
        }

        $deduccion = new Deduccion;
        $deduccion->name = $request->name;
        $deduccion->save();

        return redirect()->route('deducciones.index')
            ->with([
                'success' => 'El concepto de deducción fue agregado con exito',
        ]);
    }

    public function delete(Request $request)
    {
        $deduccion = Deduccion::find($request->name);
        $deduccion->delete();

        return redirect()->route('deducciones.index')
            ->with([
                'success' => 'El concepto de deducción fue eliminado con exito',
        ]);
    }

    public function edit(Request $request)
    {
        if (Deduccion::where('name', $request->name)->exists()) {
            return redirect()->route('deducciones.index')
            ->with([
                'error' => 'El concepto de deducción ya se encuentra registrado',
            ]);
        }

        $request->validate([
            'name' =>'required'
        ]);

        $deduccion = Deduccion::find($request->id);
        $deduccion->name = $request->name;
        $deduccion->save();

        return redirect()->route('deducciones.index')
            ->with([
                'info' => 'El concepto de deducción fue actualizado con exito',
        ]);
    }
}