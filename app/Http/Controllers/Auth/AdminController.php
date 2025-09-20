<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // metodos para crear el usuario
    public function showRegisterForm()
    {
        // return 'register form';
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:admins',
            'password' => 'required|min:8|confirmed'
        ]);

        $admin = Admin::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard')->with('success', 'Admin Registered');
    }

    //Rutas para el login del usuario
    public function showLoginForm()
    {
        return 'login form';
        //return view('auth.login);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',

        ]);


        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Incorrect Credentials']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
