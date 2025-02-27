<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Muestra el formulario de registro.
     */
    public function registerForm()
    {
        return view('auth.register');
    }

    /**
     * Maneja el registro de un nuevo usuario.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registro exitoso. Inicia sesión.');
    }

    /**
     * Muestra el formulario de login.
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    /**
     * Maneja la autenticación de usuarios.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('/')->with('success', 'Inicio de sesión exitoso.');
        }

        return back()->withErrors(['email' => 'Las credenciales no son correctas.']);
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Sesión cerrada.');
    }

    /**
     * Elimina un usuario.
     */
    public function destroy(User $user)
    {
        if (Auth::id() !== $user->id) {
            abort(403, 'No tienes permiso para eliminar esta cuenta.');
        }

        $user->delete();
        return redirect('/')->with('success', 'Cuenta eliminada.');
    }
}
