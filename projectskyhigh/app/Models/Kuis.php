<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;
    // Menentukan nama tabel di database MySQL
    protected $table = 'kuiss';

    /**
     * Atribut kuis yang diizinkan untuk diisi oleh Admin saat proses CRUD.
     */
    protected $fillable = [
        'judul_kuis',
        'deskripsi_kuis',
        'jumlah_soal',
        'waktu_menit',
    ];

    // Opsional: Jika kuis memiliki banyak soal, Anda bisa menambahkan relasi seperti di bawah ini
    // public function soal()
    // {
    //     return $this->hasMany(Soal::class);
    // }
}
