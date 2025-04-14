<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // Menampilkan halaman register
    // public function showRegisterForm()
    // {
    //     return view('register');
    // }

    // Proses registrasi
    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     Auth::login($user);

    //     return redirect()->route('home');
    // }

    public function login()
    {
        return view('login');
    }
    public function postlogin(Request $request)
{
    $cek = $request->validate([
        'email' => 'required',
        'password' => 'required'
    ]);

    if (Auth::attempt($cek)) {
        $user = Auth::user();

        switch ($user->role) {
            case 'admin':
                return redirect()->route('home')->with('status', 'Selamat datang: ' . $user->name);
            case 'kasir':
                return redirect()->route('home')->with('status', 'Selamat datang: ' . $user->name);
            case 'chef':
                return redirect()->route('home')->with('status', 'Selamat datang: ' . $user->name);
            case 'pelanggan':
                return redirect()->route('home')->with('status', 'Selamat datang: ' . $user->name);
            case 'owner':
                return redirect()->route('home')->with('status', 'Selamat datang: ' . $user->name);
            default:
                return redirect()->route('home')->with('status', 'Selamat datang: ' . $user->name);
        }
    }

    return back()->with('status', 'Email/Password salah');
}

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}

