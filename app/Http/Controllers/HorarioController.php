<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;

class HorarioController extends Controller
{
    public function index()
    {
        return view("horarios.index", [
            "horarios" => Horario::all(),
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'hr_in' =>'required','hr_out' =>'required',
        ]);

        $horario = new Horario;
        $horario->hour_in = $request->hr_in;
        $horario->hour_out = $request->hr_out;
        $horario->save();

        return redirect()->route('horarios.index')
            ->with([
                'success' => 'Un nuevo horario ha sido registrado con exito',
        ]);
    }

    public function delete(Request $request)
    {
        $horario = Horario::find($request->id);
        $horario->delete();

        return redirect()->route('horarios.index')
            ->with([
                'success' => 'El horario ha sido eliminado con exito',
        ]);
    }

    public function edit(Request $request)
    {
        $horario = Horario::find($request->id);
        $horario->hour_in = $request->hr_in;
        $horario->hour_out = $request->hr_out;
        $horario->save();

        return redirect()->route('horarios.index')
            ->with([
                'info' => 'El horario fue actualizado con exito',
        ]);
    }
}