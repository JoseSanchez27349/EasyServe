<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeseroAuthController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('mesero.login'); // Vista del formulario de login
    }

    // Procesar el login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'id' => 'required|numeric', // El ID debe ser numérico
            'password' => 'required|string', // La contraseña es obligatoria
        ]);

        if (Auth::guard('mesero')->attempt($credentials)) {
            return redirect()->route('menu'); // Redirigir al menú después del login
        }

        return back()->withErrors(['id' => 'Credenciales incorrectas']);
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::guard('mesero')->logout();
        $request->session()->invalidate();
        return redirect('/mesero/login');
    }
}