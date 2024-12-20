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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Proses login
        if (Auth::attempt($credentials)) {
            // Cek role user setelah login berhasil
            $user = Auth::user();

            if ($user->role === 'STAFF') {
                return redirect()->intended('/responses/responses'); // Redirect untuk staff
            } elseif ($user->role === 'HEAD_STAFF') {
                return redirect()->intended('/headstaff/data'); // Redirect untuk head staff
            } else {
                return redirect()->intended('/reports/article'); // Default redirect jika role lain
            }
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    // Fungsi untuk logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
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

        return redirect()->intended('/reports/article');
    }
}
