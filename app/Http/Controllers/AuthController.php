<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // -------------------- FORM LOGIN & REGISTER --------------------

    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menampilkan halaman register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // -------------------- REGISTER --------------------

    // Proses registrasi user baru
    public function register(Request $request)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'nama'     => 'required|max:255',
            'alamat'   => 'required|max:255',
            'no_hp'    => 'required|max:255',
            'email'    => 'required|email|max:255',
            'password' => 'required|min:8',
        ]);

        // Cek apakah email sudah terdaftar
        $existingUser = User::where('email', $validatedData['email'])->first();
        if ($existingUser) {
            return redirect()->back()->withInput();
        }

        // Buat akun user baru dengan role pasien
        $user = User::create([
            'nama'     => $validatedData['nama'],
            'alamat'   => $validatedData['alamat'],
            'no_hp'    => $validatedData['no_hp'],
            'email'    => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role'     => 'pasien',
        ]);

        // Redirect ke halaman login setelah berhasil register
        return redirect()->route('login');
    }

    // -------------------- LOGIN --------------------

    // Proses login user
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email'    => 'required|email|max:255',
            'password' => 'required|min:8',
        ]);

        // Cek kredensial
        if (Auth::attempt($credentials)) {
            // Jika berhasil login
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect berdasarkan role user
            if ($user->role === 'dokter') {
                return redirect()->route('dokter.dashboard');
            } elseif ($user->role === 'pasien') {
                return redirect()->route('pasien.dashboard');
            } else {
                return redirect()->route('');
            }
        }

        // Jika gagal login
        return redirect()->back()->withInput();
    }

    // -------------------- LOGOUT --------------------

    // Proses logout user
    public function logout(Request $request)
    {
        Auth::logout(); // Logout user
        $request->session()->invalidate(); // Invalidasi session
        $request->session()->regenerateToken(); // Regenerasi token CSRF

        // Redirect ke halaman login
        return redirect()->route('login');
    }
}
