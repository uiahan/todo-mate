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
            'password' => 'required|string',
        ]);

        $username = $request->input('username');
        $key = 'login_attempts_' . $username;

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors(['username' => 'Terlalu banyak percobaan login. Silakan coba lagi nanti.']);
        }

        $credentials = $request->only('username', 'password');

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            $request->session()->regenerate();

            RateLimiter::clear($key);

            Log::info('User logged in', ['username' => $user->username, 'role' => $user->role]);

            return match ($user->role) {
                'admin' => redirect()->route('admin.dashboard')->with('success', 'Anda berhasil login'),
                'tasker' => redirect()->route('tasker.dashboard')->with('success', 'Anda berhasil login'),
                'worker' => redirect()->route('worker.dashboard')->with('success', 'Anda berhasil login'),
                default => redirect()->route('home'),
            };
        }

        RateLimiter::hit($key, 60);

        throw ValidationException::withMessages([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index')->with('success', 'Anda berhasil logout');
    }
}
