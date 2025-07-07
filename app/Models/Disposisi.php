<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;
    protected $table = 'disposisi_surat';
    protected $fillable = [
        'surat_id',
        'pegawai_id',
        'dari_user_id',
        'catatan',
        'status',
    ];

    // Relasi ke surat
    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }

    // Relasi ke user yang menerima disposisi (pegawai)
    public function pegawai()
    {
        return $this->belongsTo(User::class, 'pegawai_id');
    }

    // Relasi ke user yang memberikan disposisi (misal Camat)
    public function camat()
    {
        return $this->belongsTo(User::class, 'dari_user_id');
    }
}
