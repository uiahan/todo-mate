<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index() {
        return view('pages.auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $username = $request->input('username');
        $key = 'login_attempts_' . $username;

        // Cek apakah pengguna sudah terlalu banyak mencoba login
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors(['username' => 'Terlalu banyak percobaan login. Silakan coba lagi nanti.']);
        }

        // Ambil hanya input yang diperlukan
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek apakah akun aktif
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors(['username' => 'Akun Anda tidak aktif. Silakan hubungi admin.']);
            }

            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // Hapus percobaan login setelah berhasil
            RateLimiter::clear($key);

            // Logging aktivitas login
            Log::info('User logged in', ['username' => $user->username, 'role' => $user->role]);

            // Redirect berdasarkan peran
            return match ($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'tasker' => redirect()->route('tasker.dashboard'),
                'worker' => redirect()->route('worker.dashboard'),
                default => redirect()->route('home'), // Default jika role tidak dikenali
            };
        }

        // Tambah percobaan login jika gagal
        RateLimiter::hit($key, 60); // Blok selama 60 detik setelah 5 kali gagal

        throw ValidationException::withMessages([
            'username' => 'Username atau password salah.',
        ]);
    }
}
