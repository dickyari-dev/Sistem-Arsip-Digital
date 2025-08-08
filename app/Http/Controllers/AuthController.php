<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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


    public function suratDetail($slug)
    {
        $suratDetail = Surat::where('slug', $slug)->firstOrFail();
        $disposisi = Disposisi::where('surat_id', $suratDetail->id)->get();
        $pegawai = User::where('role', 'pegawai')->get();
        return view('surat-detail', compact('suratDetail', 'disposisi', 'pegawai'));
    }

    public function profile()
    {
        return view('profile');
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'id'       => 'required|exists:users,id',
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed', // password_confirmation harus ada di form
        ]);

        // Update data user
        $user->name  = $validated['name'];
        $user->email = $validated['email'];

        // Jika password diisi, update password
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
