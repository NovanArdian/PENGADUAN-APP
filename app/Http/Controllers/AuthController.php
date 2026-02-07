<?php

// Namespace untuk controller AuthController
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Fungsi untuk menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Fungsi untuk proses login
    public function login(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Proses login
        if (Auth::attempt($credentials)) {
            // Cek role user setelah login berhasil
            $user = Auth::user();

            if ($user->role === 'STAFF') {
                return redirect()->intended('/responses/responses')->with('success', 'Selamat datang kembali, ' . $user->email . '!');
            } elseif ($user->role === 'HEAD_STAFF') {
                return redirect()->intended('/headstaff/data')->with('success', 'Selamat datang kembali, ' . $user->email . '!');
            } else {
                return redirect()->intended('/reports/article')->with('success', 'Login berhasil! Selamat datang, ' . $user->email);
            }
        }

        // Jika login gagal
        return back()->with('error', 'Email atau password salah. Silakan coba lagi.')->withInput();
    }

    // Fungsi untuk logout
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Anda telah berhasil logout. Sampai jumpa!');
    }

    // Fungsi untuk menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Fungsi untuk proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Default role adalah GUEST
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'GUEST', // Default role untuk registrasi baru
        ]);

        Auth::login($user);

        return redirect()->intended('/reports/article')->with('success', 'Registrasi berhasil! Selamat datang di LaporKan, ' . $user->email);
    }
}
