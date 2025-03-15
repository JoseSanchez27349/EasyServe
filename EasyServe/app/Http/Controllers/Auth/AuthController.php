<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar el inicio de sesión
    public function login(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        // Intentar autenticar como administrador
        if (Auth::guard('web')->attempt(['email' => $credentials['username'], 'password' => $credentials['password']])) {
            return redirect()->route('admin.dashboard');
        }

        // Intentar autenticar como mesero
        if (Auth::guard('mesero')->attempt(['nombre' => $credentials['username'], 'password' => $credentials['password']])) {
            return redirect()->route('menu');
        }

        // Si falla la autenticación, regresar con un mensaje de error
        return back()->withErrors(['username' => 'Credenciales incorrectas.']);
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        } elseif (Auth::guard('mesero')->check()) {
            Auth::guard('mesero')->logout();
        }

        return redirect()->route('inicio');
    }
}