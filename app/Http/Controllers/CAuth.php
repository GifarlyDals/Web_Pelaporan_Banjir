<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class CAuth extends Controller
{
    // ======================
    // REGISTER VIEW
    // ======================

    public function showRegister()
    {
        return view('auth.register');
    }

    // ======================
    // REGISTER PROCESS
    // ======================

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')
               ->with('success', 'Register berhasil');
    }

    // ======================
    // LOGIN VIEW
    // ======================

    public function showLogin()
    {
        return view('auth.login');
    }

    // ======================
    // LOGIN PROCESS
    // ======================

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect('/home');
        }

        return back()->with(
            'error',
            'Email atau password salah'
        );
    }

    // ======================
    // LOGOUT
    // ======================

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
