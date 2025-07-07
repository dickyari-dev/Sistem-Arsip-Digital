<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CamatController extends Controller
{
    public function dashboard()
    {
        return view('camat.dashboard');
    }

    public function surat()
    {
        $surats = Surat::all();
        return view('camat.surat', compact('surats'));
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

        $surats = $query->latest()->get();

        return view('camat.surat', [  // ganti dengan nama view Anda
            'surats' => $surats,
            'filter' => $request->all(), // agar bisa isi ulang filter
        ]);
    }


    public function suratDisposisi()
    {
        $surats = Surat::where('status_disposisi', 'disposisi')->get();
        return view('camat.surat', compact('surats'));
    }
    public function suratPending()
    {
        $surats = Surat::where('status_disposisi', 'pending')->get();
        return view('camat.surat', compact('surats'));
    }

    public function revisiSurat(Request $request)
    {
        $validate = $request->validate([
            'surat_id' => 'required',
            'keterangan_revisi' => 'required',
        ]);

        Surat::find($request->surat_id)->update([
            'status_revisi' => 'revisi',
            'keterangan_revisi' => $request->keterangan_revisi,
            'jawaban_revisi' => '',
        ]);
        return redirect()->back()->with('success', 'Revisi surat telah di kirimkan, silahkan menunggu admin memproses revisi.');
    }

    public function disposisi(Request $request)
    {
        $validate = $request->validate([
            'surat_id' => 'required',
            'pegawai_id' => 'required|exists:users,id',
        ]);

        // Cek Pegawai
        $pegawai = User::find($request->pegawai_id);
        if (!$pegawai) {
            return redirect()->route('camat.surat')->with('error', 'Pegawai tidak dikenali.');
        }
        if ($pegawai->role !== 'pegawai') {
            return redirect()->route('camat.surat')->with('error', 'User yang dipilih bukan Pegawai.');
        }

        // Cek apakah user sudah pernah menerima disposisi surat
        $disposisi = Disposisi::where('surat_id', $request->surat_id)->where('pegawai_id', $request->pegawai_id)->first();
        if ($disposisi) {
            return redirect()->route('camat.surat')->with('error', 'Pegawai ini sudah pernah menerima disposisi surat ini.');
        }

        Surat::find($request->surat_id)->update([
            'status_disposisi' => 'disposisi',
        ]);

        // Disposisi
        Disposisi::create([
            'surat_id'     => $request->surat_id,
            'pegawai_id'   => $request->pegawai_id,
            'catatan'      => $request->catatan,
            'dari_user_id' => Auth::user()->id,
            'status' => 'belum_dibaca',
        ]);

        return redirect()->back()->with('success', 'Surat berhasil Disposisi ke Pegawai.');
    }

    public function batalDisposisi($id) {
        $disposisi = Disposisi::find($id);

        if (!$disposisi) {
            return redirect()->route('camat.surat')->with('error', 'Disposisi tidak dikenali.');
        }

        $disposisi->delete();

        // Cek Jumlah Disposisi
        $disposisiCount = Disposisi::where('surat_id', $disposisi->surat_id)->count();
        if ($disposisi == 0) {
            Surat::find($disposisi->surat_id)->update([
                'status_disposisi' => 'pending',
            ]);
        }

        return redirect()->back()->with('success', 'Disposisi berhasil dibatalkan.');

    }
}
