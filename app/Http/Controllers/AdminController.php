<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

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

        $validated['file_surat'] = $request->file('file_surat')->store('surat_files', 'public');
        $validated['admin_id'] = auth()->id();

        Surat::create($validated);

        return redirect()->route('admin.surat')->with('success', 'Surat berhasil ditambahkan.');
    }
    public function suratFilterPost(Request $request)
    {
        $query = Surat::query();

        // Filter berdasarkan input
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

        // Ambil hasil
        $surats = $query->latest()->get();

        // Kirim kembali input filter ke view agar terisi ulang
        return view('admin.surat', [
            'surats' => $surats,
            'request' => $request
        ]);
    }
}
