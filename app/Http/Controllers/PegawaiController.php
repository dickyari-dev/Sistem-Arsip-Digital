<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function dashboard()
    {
        return view('pegawai.dashboard');
    }


    public function surat()
{
    $userId = Auth::id();

    $surats = DB::table('disposisi_surat')
        ->leftJoin('surats', 'disposisi_surat.surat_id', '=', 'surats.id')
        ->leftJoin('users as camat', 'disposisi_surat.dari_user_id', '=', 'camat.id') // join ke users
        ->where('disposisi_surat.pegawai_id', $userId)
        ->select(
            'surats.*',
            'disposisi_surat.catatan',
            'disposisi_surat.status as status_dibaca',
            'camat.name as nama_camat_pendisposisi' // ambil nama camat
        )
        ->get();

    return view('pegawai.surat', compact('surats'));
}
}
