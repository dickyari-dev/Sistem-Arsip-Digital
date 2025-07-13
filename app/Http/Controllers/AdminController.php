<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function suratCreate()
    {
        return view('admin.surat-create');
    }
    public function surat()
    {
        $surats = Surat::all();
        return view('admin.surat', compact('surats'));
    }
    public function suratCreatePost(Request $request)
    {
        $validated = $request->validate([
            'nama_surat'     => 'required|string|max:255',
            'nomor_surat'    => 'required|unique:surats',
            'kode_surat'     => 'nullable|string|max:100',
            'tanggal_surat'  => 'required|date',
            'pengirim'       => 'required|string|max:255',
            'penerima'       => 'required|string|max:255',
            'jenis_surat'    => 'required|in:masuk,keluar',
            'perihal'        => 'nullable|string',
            'keterangan'     => 'nullable|string',
            'file_surat'     => 'required|mimes:pdf, doc, docx, xls, xlsx|max:10048',
        ]);

        // Create Slug 
        $random = Str::random(5); // bisa diubah panjangnya
        $namaSuratSlug = Str::slug($validated['nama_surat']);
        $validated['slug'] = $random . '-' . $namaSuratSlug;

        $validated['file_surat'] = $request->file('file_surat')->store('surat_files', 'public');
        $validated['admin_id'] = auth()->id();
        $validated['status_disposisi'] = 'pending';
        $validated['status_revisi'] = 'pending';

        Surat::create($validated);

        return redirect()->route('admin.surat')->with('success', 'Surat berhasil ditambahkan.');
    }
    public function suratFilterPost(Request $request)
    {
        $query = Surat::query();

        if ($request->filled('nama_surat')) {
            $query->where('nama_surat', 'like', '%' . $request->nama_surat . '%');
        }

        if ($request->filled('nomor_surat')) {
            $query->where('nomor_surat', 'like', '%' . $request->nomor_surat . '%');
        }

        if ($request->filled('kode_surat')) {
            $query->where('kode_surat', 'like', '%' . $request->kode_surat . '%');
        }

        if ($request->filled('status_disposisi')) {
            $query->where('status_disposisi', $request->status_disposisi);
        }
        if ($request->filled('status_revisi')) {
            $query->where('status_revisi', $request->status_revisi);
        }

        $surats = $query->latest()->get();

        return view('admin.surat', [  // ganti dengan nama view Anda
            'surats' => $surats,
            'filter' => $request->all(), // agar bisa isi ulang filter
        ]);
    }

    public function suratEdit($slug)
    {
        $surat = Surat::where('slug', $slug)->first();
        return view('admin.surat-edit', compact('surat'));
    }

    public function suratEditPost(Request $request)
    {
        $validated = $request->validate([
            'id'             => 'required|exists:surats,id',
            'nama_surat'     => 'required|string|max:255',
            'nomor_surat'    => 'required|string|max:255|unique:surats,nomor_surat,' . $request->id,
            'kode_surat'     => 'nullable|string|max:100',
            'tanggal_surat'  => 'required|date',
            'pengirim'       => 'required|string|max:255',
            'penerima'       => 'required|string|max:255',
            'jenis_surat'    => 'required|in:masuk,keluar',
            'perihal'        => 'nullable|string',
            'keterangan'     => 'nullable|string',
            'file_surat'     => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:10048',
        ]);


        $surat = Surat::find($validated['id']);

        if (!$surat) {
            return redirect()->route('admin.surat')->with('error', 'Surat tidak ditemukan.');
        }

        if ($request->hasFile('file_surat')) {
            $validated['file_surat'] = $request->file('file_surat')->store('surat_files', 'public');
        }

        $validated['status_revisi'] = 'selesai';

        $surat->update($validated);

        return redirect()->route('admin.surat')->with('success', 'Surat berhasil diperbarui.');
    }


    public function suratDisposisi()
    {
        $surats = Surat::where('status_disposisi', 'disposisi')->get();
        return view('admin.surat', compact('surats'));
    }
    public function suratPending()
    {
        $surats = Surat::where('status_disposisi', 'pending')->get();
        return view('admin.surat', compact('surats'));
    }
    public function userFilterPost(Request $request)
    {
        $query = User::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->get();

        return view('admin.user', [  // ganti dengan nama view Anda
            'users' => $users,
            'filter' => $request->all(), // agar bisa isi ulang filter
        ]);
    }

    // User
    public function user()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }

    public function userCreate()
    {
        return view('admin.user-create');
    }

    public function userCreatePost(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,camat,pegawai',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan user ke database
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.user')->with('success', 'User berhasil ditambahkan.');
    }

    public function userEdit($id)
    {
        $user = User::find($id);
        return view('admin.user-edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|max:255|unique:users,email,{$id}",
            'role' => 'required|in:admin,camat,pegawai',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update data user
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        // Jika password diisi, update password
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.user')->with('success', 'Data user berhasil diperbarui.');
    }
}
