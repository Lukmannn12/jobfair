<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{

    public function showRegister()
    {
        return view('auth.register');
    }

    public function showlogin() {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'in:job_seeker,employer'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);


        // Redirect sesuai role
        if ($user->role === 'employer') {
            return redirect()->route('employer.dashboard')->with('success', 'Welcome Employer!');
        }

        return redirect()->route('home')->with('success', 'Welcome!');
    }

    public function login(Request $request)
{
    // Validasi input
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Cek login
    if (Auth::attempt($credentials)) {
        // Regenerate session untuk keamanan
        $request->session()->regenerate();

        // Redirect sesuai role
        $user = Auth::user();
        if ($user->role === 'employer') {
            return redirect()->route('employer.dashboard')->with('success', 'Login berhasil. Welcome Employer!');
        } elseif ($user->role === 'job_seeker') {
            return redirect()->route('home')->with('success', 'Login berhasil. Welcome Job Seeker!');
        }

        // Default redirect jika role tidak dikenali
        return redirect()->route('home')->with('success', 'Login berhasil.');
    }

    // Jika gagal login
    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
}


    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Hapus session dan generate token baru
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login dengan pesan
        return redirect()->route('home')->with('success', 'Berhasil logout.');
    }
}
