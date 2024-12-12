<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function viewLogin()
    {
        try {
            return view('auth.login');
        } catch (\Exception $e) {
            return redirect()->route('/');
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('usuarios.index')->with('success', 'Inicio de sesión exitoso.');
            }
        }

        return back()->withErrors([
            'email' => 'Las credenci  ales no coinciden con nuestros registros.',
        ]);
    }

    public function viewRegister()
    {
        try {
            return view('auth.register');
        } catch (\Exception $e) {
            return redirect()->route('/');
        }
    }

    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
            'names' => 'required|string|max:255',
            'lastnames' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required|string',
            'password' => 'required|confirmed|min:8',
            ]);
            $user = User::create([
                'names' => $validated['names'],
                'lastnames' => $validated['lastnames'],
                'email' => $validated['email'],
                'gender' => $validated['gender'],
                'password' => Hash::make($validated['password']),
            ]);

            //dd($user);

            return redirect()->route('login')->with('success', 'Usuario creado de manera exitosa');
        } catch (\Exception $e) {
            return redirect()->back('login');
            
        }
    }


    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate(); // Invalidamos la sesión actual
            $request->session()->regenerateToken(); // Regeneramos el token CSRF para prevenir ataques de falsificación
            return redirect()->route('login');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
