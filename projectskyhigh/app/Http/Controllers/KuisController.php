<?php

namespace App\Http\Controllers;

use App\Models\Kuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KuisController extends Controller
{
    // ==========================================
    // 1. FITUR CRUD WADAH KUIS UTAMA
    // ==========================================

    public function index()
    {
        $kuis = Kuis::all(); 
        return view('kuis', compact('kuis'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('kuis.index')->with('error', 'Akses ditolak!');
        }
        return view('kuis_create'); 
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'judul_kuis' => 'required|string|max:255',
            'deskripsi_kuis' => 'required|string',
            'jumlah_soal' => 'required|integer',
            'waktu_menit' => 'required|integer'
        ]);

        Kuis::create($request->all());

        return redirect()->route('kuis.index')->with('success', 'Kuis berhasil ditambahkan!');
    }

    /**
     * SHOW: Menampilkan Detail Kuis (Info, Peringkat, dan Bank Soal)
     */
    public function show($id)
    {
        $kuis = Kuis::findOrFail($id);
        
        // Mengambil riwayat nilai (Leaderboard)
        $riwayat = DB::table('hasil_kuis')
            ->join('users', 'users.id', '=', 'hasil_kuis.users_id')
            ->where('kuiss_id', $id)
            ->select('users.name', 'hasil_kuis.nilai', 'hasil_kuis.created_at')
            ->orderByDesc('hasil_kuis.nilai')
            ->get();

        // Mengambil daftar soal untuk dikelola oleh Admin
        $daftar_soal = DB::table('soal_kuis')
            ->where('kuiss_id', $id)
            ->get();

        // Mengirimkan ketiga data di atas ke view kuis_detail
        return view('kuis_detail', compact('kuis', 'riwayat', 'daftar_soal'));
    }

    public function edit($id)
    {
        if (Auth::user()->role !== 'admin') return redirect()->route('kuis.index');

        $kuis = Kuis::findOrFail($id);
        return view('kuis_edit', compact('kuis'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'judul_kuis' => 'required|string|max:255',
            'deskripsi_kuis' => 'required|string',
            'jumlah_soal' => 'required|integer',
            'waktu_menit' => 'required|integer'
        ]);

        $kuis = Kuis::findOrFail($id);
        $kuis->update($request->all());

        return redirect()->route('kuis.index')->with('success', 'Kuis berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $kuis = Kuis::findOrFail($id);
        $kuis->delete();

        return redirect()->route('kuis.index')->with('success', 'Kuis berhasil dihapus!');
    }

    // ==========================================
    // 2. FITUR MANAJEMEN BANK SOAL (KHUSUS ADMIN)
    // ==========================================
    
    public function createSoal($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        
        $kuis = Kuis::findOrFail($id);
        return view('soal_create', compact('kuis'));
    }

    public function storeSoal(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        
        // QA: Validasi inputan soal
        $request->validate([
            'pertanyaan' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ]);

        // Simpan data ke database tabel soal_kuis
        DB::table('soal_kuis')->insert([
            'kuiss_id' => $id,
            'pertanyaan' => $request->pertanyaan,
            'opsi_a' => $request->opsi_a,
            'opsi_b' => $request->opsi_b,
            'opsi_c' => $request->opsi_c,
            'opsi_d' => $request->opsi_d,
            'jawaban_benar' => $request->jawaban_benar,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('kuis.show', $id)->with('success', 'Soal baru berhasil ditambahkan ke Bank Soal!');
    }

    public function destroySoal($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        
        $soal = DB::table('soal_kuis')->where('id', $id)->first();
        if ($soal) {
            $kuis_id = $soal->kuis_id;
            DB::table('soal_kuis')->where('id', $id)->delete();
            return redirect()->route('kuis.show', $kuis_id)->with('success', 'Soal berhasil dihapus.');
        }
        return redirect()->back();
    }

    // ==========================================
    // 3. FITUR UJIAN ( USER)
    // ==========================================
    
    public function mulai($id)
    {
        $kuis = Kuis::findOrFail($id);
        
        // Ambil soal secara acak sesuai batas `jumlah_soal` yang diatur admin
        $soal = DB::table('soal_kuis')
                    ->where('kuiss_id', $id)
                    ->inRandomOrder()
                    ->limit($kuis->jumlah_soal)
                    ->get();

        // QA: Tolak masuk ujian jika jumlah soal belum memenuhi standar kuis
        if($soal->count() < $kuis->jumlah_soal) {
            return back()->with('error', 'Kuis belum siap dikerjakan.');
        }

        return view('kuis_mulai', compact('kuis', 'soal'));
    }

    public function submit(Request $request, $id)
    {
        $jawaban_user = $request->jawaban; 
        $benar = 0;

        // Mencocokkan jawaban user dengan kunci jawaban di database
        if($jawaban_user) {
            foreach($jawaban_user as $soal_id => $jawaban) {
                $soal_asli = DB::table('soal_kuis')->where('id', $soal_id)->first();
                if($soal_asli && $soal_asli->jawaban_benar == $jawaban) {
                    $benar++;
                }
            }
        }

        // Kalkulasi nilai 0 - 100
        $jumlah_soal_ditampilkan = $request->jumlah_soal_ditampilkan > 0 ? $request->jumlah_soal_ditampilkan : 1;
        $nilai_akhir = round(($benar / $jumlah_soal_ditampilkan) * 100);

        // Simpan nilai ke tabel Leaderboard
        DB::table('hasil_kuis')->insert([
            'kuiss_id' => $id,
            'users_id' => Auth::id(),
            'nilai' => $nilai_akhir,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('kuis.show', $id)->with('success', 'Kuis selesai! Anda mendapatkan nilai: ' . $nilai_akhir);
    }
}