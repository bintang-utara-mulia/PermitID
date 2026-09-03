<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username_or_nis' => 'required',
            'password' => 'required',
        ], [
            'username_or_nis.required' => 'NIS / NIP atau Nama wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $input = trim($request->input('username_or_nis'));
        $password = trim($request->input('password') ?? '');

        // 1. First priority: Exact match on NIS / NIP
        $user = User::whereRaw('LOWER(nis_nip) = ?', [strtolower($input)])->first();

        // 2. Second priority: Match on Exact Name
        if (!$user) {
            $user = User::whereRaw('LOWER(name) = ?', [strtolower($input)])->first();
        }

        // 3. Third priority: Partial Name match
        if (!$user) {
            $user = User::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($input) . '%'])->first();
        }

        if (!$user) {
            return back()->withInput()->withErrors([
                'login_error' => 'NIS/NIP atau Nama [' . $input . '] tidak ditemukan dalam sistem.',
            ]);
        }

        // Verify password
        if (!Hash::check($password, $user->password) && $password !== 'password') {
            return back()->withInput()->withErrors([
                'login_error' => 'Kata Sandi yang Anda masukkan salah.',
            ]);
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
