<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Asignacion;
use App\Models\Deduccion;
use App\Models\Employee;
use App\Models\Departamento;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function signIn(Request $request)
    {
        $request->validate([
            'cedula' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('cedula', 'password');

        if (Auth::attempt($credentials)) {
            return view('auth.modulos')->with('userID', Auth::id());
        }

        return redirect("login")->withErrors('La identificación y/o contraseña son inválidas');
    }

    public function nomina(Request $request, $id)
    {

            $request->session()->put('modulo', 'nomina');

            return redirect()->route('nomina.index');
    }

    public function prenomina(Request $request, $id)
    {

            $request->session()->put('modulo', 'prenomina');

            return redirect()->route('prenomina.index');
    }



    public function showRegister()
    {
        return view('auth.register');
    }

    public function signUp(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cedula' => 'required',
            'password' => 'required|min:1',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("/login")->withSuccess('Usuario agregado');  
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'cedula' => $data['cedula'],
        'password' => Hash::make($data['password'])
      ]);
    }    

    public function logOut() {
        Session::flush();
        Auth::logout();
  
        return redirect('login');
    }

    /* MODULOS */

    public function options(Request $request) {
        $request->session()->forget(['modulo', 'from_to', 'dpto']);

        return view('auth.modulos');
    }
}
