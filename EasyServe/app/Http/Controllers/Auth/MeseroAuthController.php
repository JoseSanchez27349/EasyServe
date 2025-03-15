<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeseroAuthController extends Controller
{
    // Mostrar formulario de inicio de sesión para meseros
    public function showLoginForm()
    {
        return view('auth.mesero_login');
    }

    // Procesar el inicio de sesión para meseros
    public function login(Request $request)
    {
        $credentials = $request->only('nombre', 'password');

        if (Auth::guard('mesero')->attempt($credentials)) {
            return redirect()->route('menu');
        }

        return back()->withErrors(['nombre' => 'Credenciales incorrectas.']);
    }

    // Cerrar sesión para meseros
    public function logout(Request $request)
    {
        Auth::guard('mesero')->logout();
        return redirect()->route('inicio');
    }
}