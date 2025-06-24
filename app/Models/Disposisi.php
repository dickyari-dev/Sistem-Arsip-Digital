<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;
    protected $fillable = [
        'surat_id',
        'camat_id',
        'pegawai_id',
        'catatan',
        'tanggal_disposisi',
    ];

    // Relasi ke surat
    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }

    // Relasi ke camat (user yang melakukan disposisi)
    public function camat()
    {
        return $this->belongsTo(User::class, 'camat_id');
    }

    // Relasi ke pegawai (user yang menerima disposisi)
    public function pegawai()
    {
        return $this->belongsTo(User::class, 'pegawai_id');
    }
    public function disposisiSebagaiCamat()
    {
        return $this->hasMany(Disposisi::class, 'camat_id');
    }

    public function disposisiSebagaiPegawai()
    {
        return $this->hasMany(Disposisi::class, 'pegawai_id');
    }
}
