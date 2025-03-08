<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use finfo;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador de usuarios.
 */
class UserController extends Controller
{
    /**
     * Maneja el registro de un nuevo usuario.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
            'email' => [
                'required',
                'email:rfc,dns',
                'unique:users,email',
                'regex:/^[a-zA-Z]+[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ]
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 20 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'email.regex' => 'El correo electrónico debe empezar con una letra, contener "@" y un dominio válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.regex' => 'La contraseña debe contener al menos una mayúscula, un número y un carácter especial.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect('/posts')->with('success', 'Registro exitoso. Bienvenido.');
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

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            return redirect('/posts')->with('success', 'Bienvenido.');
        }

        return back()->withErrors(['email' => 'Las credenciales no son correctas.']);
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Sesión cerrada.');
    }


    /**
     * Muestra la vista de confirmación de eliminación de cuenta.
     */
    public function confirmDelete(): View
    {
        return view('user.confirmar_eliminacion');
    }


    /**
     * Elimina un usuario después de confirmar la contraseña.
     */
    public function destroy($id)
    {
        $user = User::findOrFail( $id );


        Auth::logout(); // Cierra la sesión
        $user->delete(); // Elimina el usuario

        return redirect('/')->with('success', 'Cuenta eliminada.');
    }


    /**
     * Muestra el perfil de un usuario y sus posts.
     */
    public function profile($id): View
    {
        if (Auth::id() !== $id) {
            abort(403, 'No tienes permiso para eliminar esta cuenta.');
        }
        
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy("created_at", "desc")->get();
        return view("user.profile", compact("user", "posts"));
    }

    /**
     * Página en construcción para edición de perfil.
     */
    public function edit()
    {
        return view('user.edit');
    }

    /**
     * Muestra el formulario de registro.
     * @return \Illuminate\Contracts\View\View
     */
    public function showRegisterForm()
    {
        return view('user.register');
    }


    /**
     * Muestra el formulario de login.
     * @return \Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        return view('user.login');
    }

}
