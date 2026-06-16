<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    // 1. Fungsi untuk menampilkan halaman form Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // 2. Fungsi untuk menampilkan halaman form Register
    public function showRegister()
    {
        return view('auth.register');
    }

    // 3. Fungsi untuk memproses data pendaftaran ke Database
    public function prosesRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password diamankan
            'role' => 'user'
        ]);

        return redirect()->route('login')->with('success', 'Berhasil mendaftar! Silakan login.');
    }

    // 4. Fungsi untuk memproses pengecekan Login
    public function prosesLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Jika berhasil, arahkan ke dashboard
            return redirect()->route('dashboard'); 
        }

        // Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors(['email' => 'Email atau password salah!'])->withInput();
    }

    // 5. Fungsi untuk Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    public function index() {
        $materis = Materi::all();
        return view('materi.index', compact('materis'));
    }

    public function create() {
        // Hanya Admin yang boleh membuat materi (Bisa dicek via Middleware/Gate, ini contoh sederhana)
        if(auth()->user()->role !== 'admin') return redirect()->back();
        return view('materi.create');
    }

    public function store(Request $request) {
        Materi::create($request->all());
        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan!');
    }
}
