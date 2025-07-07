<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang!');
            } elseif ($user->role === 'camat') {
                return redirect()->route('camat.dashboard')->with('success', 'Selamat datang!');
            } elseif ($user->role === 'pegawai') {
                return redirect()->route('pegawai.dashboard')->with('success', 'Selamat datang!');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Role tidak dikenali.');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    public function suratDetail($slug) {
        $suratDetail = Surat::where('slug', $slug)->firstOrFail();
        $disposisi = Disposisi::where('surat_id', $suratDetail->id)->get();
        $pegawai = User::where('role', 'pegawai')->get();
        return view('surat-detail', compact('suratDetail', 'disposisi', 'pegawai'));
    }
}
