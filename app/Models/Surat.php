<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nama_surat',
        'slug',
        'nomor_surat',
        'kode_surat',
        'file_surat',
        'tanggal_surat',
        'pengirim',
        'penerima',
        'jenis_surat',
        'status_disposisi',
        'status_revisi',
        'keterangan_revisi',
        'jawaban_revisi',
        'perihal',
        'keterangan',
        'admin_id',
    ];

    /**
     * Relasi ke Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke User (admin yang input)
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Relasi ke Disposisi (jika satu surat punya banyak disposisi)
     */
    public function disposisis()
    {
        return $this->hasMany(Disposisi::class);
    }
}
