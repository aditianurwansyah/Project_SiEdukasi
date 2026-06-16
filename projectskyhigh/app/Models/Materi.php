<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    // Menentukan nama tabel secara spesifik (karena bahasa Indonesia)
    protected $table = 'materis';

    /**
     * Atribut yang diizinkan untuk diisi data (CRUD - Create & Update)
     * Kolom ini menyesuaikan dengan file migration yang dibuat di awal.
     */
    protected $fillable = [
        'judul',
        'deskripsi',
        'konten_materi',
        'file_lampiran', 
        'link_video'
    ];
}
