<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Memproses login menggunakan username dan NIP.
     * NIP digunakan sebagai password sesuai kebutuhan sistem.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'NIP wajib diisi.',
        ]);

        $remember = $request->boolean('remember');

        if (
            Auth::attempt([
                'username' => $credentials['username'],
                'password' => $credentials['password'],
                'is_active' => true,
            ], $remember)
        ) {
            $request->session()->regenerate();

            return redirect()
                ->intended(route('dashboard'))
                ->with('success', 'Selamat datang di BGTK Monev.');
        }

        return back()
            ->withErrors([
                'username' => 'Username, NIP, atau status akun tidak sesuai.',
            ])
            ->onlyInput('username');
    }

    /**
     * Memproses logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Anda berhasil keluar dari sistem.');
    }
}
