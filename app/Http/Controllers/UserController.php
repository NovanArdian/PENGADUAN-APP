<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StaffProvince;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $staffs = User::where('role', 'STAFF')->with('staffProvinces')->get();
        return view('hstaff.create', compact('staffs'));
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'STAFF') {
            return redirect()->back()->with('error', 'Hanya dapat menghapus akun staff.');
        }

        $user->staffProvinces()->delete();
        $user->delete();
        
        return redirect()->route('staff.index')->with('success', 'Staff berhasil dihapus.');
    }

    public function resetPassword(User $user)
    {
        if ($user->role !== 'STAFF') {
            return redirect()->back()->with('error', 'Hanya dapat reset password staff.');
        }

        $user->update(['password' => Hash::make('password123')]);

        return redirect()->route('staff.index')->with('success', 'Password berhasil direset menjadi password123.');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'province' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->with('error', 'Data tidak valid. Periksa email dan password.')->withInput();
        }
    
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'STAFF',
        ]);
    
        StaffProvince::create([
            'user_id' => $user->id,
            'province' => $request->province,
        ]);
    
        return redirect()->route('staff.index')->with('success', 'Staff berhasil ditambahkan.');
    }
}
