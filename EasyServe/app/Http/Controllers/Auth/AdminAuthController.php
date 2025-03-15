<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Mostrar formulario de inicio de sesión para administradores
    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

    // Procesar el inicio de sesión para administradores
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }

    // Cerrar sesión para administradores
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect()->route('inicio');
    }
}