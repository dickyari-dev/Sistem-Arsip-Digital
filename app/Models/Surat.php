<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [
        'nama_surat',
        'nomor_surat',
        'file_surat',
        'kode_surat',
        'tanggal_surat',
        'pengirim',
        'penerima',
        'jenis_surat',
        'status_disposisi',
        'keterangan_revisi',
        'perihal',
        'keterangan',
        'admin_id',
    ];

    // Relasi ke user (admin yang input)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Relasi ke disposisi (jika satu surat hanya satu disposisi)
    public function disposisi()
    {
        return $this->hasOne(Disposisi::class);
    }

    // Jika satu surat bisa didisposisikan ke beberapa pegawai (opsional)
    public function semuaDisposisi()
    {
        return $this->hasMany(Disposisi::class);
    }
}
