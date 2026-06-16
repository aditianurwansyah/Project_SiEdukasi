<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk mengelola file

class MateriController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel materis
        $materis = Materi::all(); 
        
        // Menampilkan ke file resources/views/materi.blade.php
        return view('materi', compact('materis'));
    }

    /**
     * CREATE: Menampilkan form tambah materi. (Hanya Admin)
     */
    public function create()
    {
        // Cek jika bukan admin, tendang kembali ke halaman materi
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('materi.index')->with('error', 'Anda tidak memiliki akses ke halaman ini!');
        }

        // Anda perlu membuat view form-nya, misal: resources/views/materi_create.blade.php
        return view('materi_create'); 
    }

    /**
     * STORE: Menyimpan data materi baru ke database. (Hanya Admin)
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        // Validasi inputan diperbarui untuk menerima file dan link video
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'konten_materi' => 'required',
            'link_video' => 'nullable|url', // Validasi link URL
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240' // Maks 10MB
        ]);

        $data = $request->all();

        // Logika untuk menyimpan file lampiran
        if ($request->hasFile('file_lampiran')) {
            $file = $request->file('file_lampiran');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            // Simpan file ke folder storage/app/public/lampiran
            $file->storeAs('public/lampiran', $nama_file);
            $data['file_lampiran'] = $nama_file;
        }

        // Simpan ke MySQL menggunakan variabel $data yang sudah berisi nama file
        Materi::create($data);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan!');
    }

    /**
     * SHOW: Menampilkan detail 1 materi. (Admin & User)
     */
    public function show($id)
    {
        $materi = Materi::findOrFail($id);
        return view('materi_detail', compact('materi'));
    }

    /**
     * EDIT: Menampilkan form edit materi. (Hanya Admin)
     */
    public function edit($id)
    {
        if (Auth::user()->role !== 'admin') return redirect()->route('materi.index');

        $materi = Materi::findOrFail($id);
        return view('materi_edit', compact('materi'));
    }

    /**
     * UPDATE: Menyimpan perubahan data materi ke database. (Hanya Admin)
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        // Validasi yang sama dengan proses store
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'konten_materi' => 'required',
            'link_video' => 'nullable|url',
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240'
        ]);

        $materi = Materi::findOrFail($id);
        $data = $request->all();

        // Logika jika Admin mengunggah file baru saat mengedit materi
        if ($request->hasFile('file_lampiran')) {
            $file = $request->file('file_lampiran');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->storeAs('public/lampiran', $nama_file);
            $data['file_lampiran'] = $nama_file;

            // (Opsional) Hapus file lama dari storage agar tidak memenuhi ruang memori server
            if ($materi->file_lampiran) {
                Storage::delete('public/lampiran/' . $materi->file_lampiran);
            }
        }

        $materi->update($data);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui!');
    }

    /**
     * DESTROY: Menghapus materi dari database. (Hanya Admin)
     */
    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $materi = Materi::findOrFail($id);
        
        // Hapus file fisik dari storage jika ada, sebelum datanya dihapus dari MySQL
        if ($materi->file_lampiran) {
            Storage::delete('public/lampiran/' . $materi->file_lampiran);
        }

        $materi->delete();

        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus!');
    }
}