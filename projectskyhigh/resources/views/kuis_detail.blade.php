<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kuis->judul_kuis }} - SiEdukasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .delay-100 { animation-delay: 0.1s; }
    </style>
</head>
<body class="bg-slate-50 text-slate-700 font-sans antialiased">

    <!-- Navigasi -->
    <nav class="bg-white shadow-sm px-6 py-4 flex justify-between items-center sticky top-0 z-50">
        <div class="text-2xl font-bold text-teal-600">SiEdukasi</div>
        <div class="flex gap-6 items-center">
            <a href="{{ route('dashboard') }}" class="hover:text-teal-500 transition">Beranda</a>
            <a href="{{ route('materi.index') }}" class="hover:text-teal-500 transition">Materi</a>
            <a href="{{ route('kuis.index') }}" class="font-bold text-teal-600 border-b-2 border-teal-500 pb-1">Kuis</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-rose-100 text-rose-600 px-4 py-2 rounded-full hover:bg-rose-200 transition text-sm font-semibold">Logout</button>
            </form>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto mt-10 px-6 mb-20">
        <a href="{{ route('kuis.index') }}" class="inline-flex items-center gap-2 text-purple-600 hover:text-purple-500 font-semibold mb-6 transition-all duration-300 hover:-translate-x-1">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Kuis
        </a>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-6 rounded-3xl mb-8 shadow-sm flex items-center justify-between opacity-0 animate-fade-up">
                <div>
                    <h3 class="text-xl font-bold mb-1">🎉 Selamat, Kuis Diselesaikan!</h3>
                    <p class="font-medium text-emerald-600">{{ session('success') }}</p>
                </div>
                <div class="text-5xl">🏆</div>
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-rose-50 text-rose-600 p-4 rounded-xl mb-6 font-medium">{{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Kolom Info Kuis -->
            <div class="md:col-span-2 space-y-6 opacity-0 animate-fade-up">
                <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
                    <h1 class="text-3xl font-extrabold text-slate-800 mb-4">{{ $kuis->judul_kuis }}</h1>
                    <p class="text-slate-500 mb-8">{{ $kuis->deskripsi_kuis }}</p>

                    <div class="flex gap-4 mb-8">
                        <div class="bg-purple-50 text-purple-700 px-6 py-4 rounded-2xl flex-1 text-center">
                            <i class="fa-solid fa-list-check text-2xl mb-2"></i>
                            <div class="text-sm text-purple-500 font-semibold">Total Soal</div>
                            <div class="text-2xl font-bold">{{ $kuis->jumlah_soal }}</div>
                        </div>
                        <div class="bg-amber-50 text-amber-700 px-6 py-4 rounded-2xl flex-1 text-center">
                            <i class="fa-solid fa-stopwatch text-2xl mb-2"></i>
                            <div class="text-sm text-amber-500 font-semibold">Durasi Waktu</div>
                            <div class="text-2xl font-bold">{{ $kuis->waktu_menit }} Menit</div>
                        </div>
                    </div>

                    <!-- Tombol Mulai (Hanya untuk User) -->
                    @if(Auth::user()->role === 'user')
                        <a href="{{ route('kuis.mulai', $kuis->id) }}" class="block w-full text-center bg-purple-500 text-white font-bold text-lg px-6 py-4 rounded-2xl hover:bg-purple-600 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            🚀 Mulai Kerjakan Kuis Sekarang
                        </a>
                    @else
                        <div class="bg-slate-50 text-slate-500 text-center p-4 rounded-xl text-sm font-medium">
                            <i class="fa-solid fa-circle-info"></i> Admin tidak dapat mengerjakan kuis. Anda hanya dapat memantau perolehan nilai.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Kolom Leaderboard / Hasil -->
            <div class="opacity-0 animate-fade-up delay-100">
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="bg-purple-500 p-6 text-center">
                        <h2 class="text-xl font-bold text-white"><i class="fa-solid fa-trophy text-amber-300 mr-2"></i> Leaderboard</h2>
                        <p class="text-purple-100 text-sm mt-1">Nilai Tertinggi Kuis Ini</p>
                    </div>
                    
                    <div class="p-2 max-h-[400px] overflow-y-auto">
                        @forelse($riwayat as $index => $hasil)
                            <div class="flex items-center justify-between p-4 border-b border-slate-50 last:border-0 hover:bg-slate-50 rounded-xl transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-500 text-xs">
                                        {{ $index + 1 }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-700 text-sm">{{ $hasil->name }}</div>
                                        <div class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($hasil->created_at)->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <div class="text-lg font-extrabold text-purple-600">
                                    {{ $hasil->nilai }}
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center text-slate-400 text-sm">
                                Belum ada user yang menyelesaikan kuis ini.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="lg:col-span-2 space-y-6">
        @if(Auth::user()->role === 'admin')
            <!-- Panel Kelola Soal -->
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-slate-800">Bank Soal</h2>
                    <a href="{{ route('soal.create', $kuis->id) }}" class="bg-purple-600 text-white px-5 py-3 rounded-xl font-bold hover:bg-purple-700 transition">
                        <i class="fa-solid fa-plus mr-2"></i> Tambah Soal
                    </a>
                </div>
                
                <!-- Loop daftar soal disini -->
                @foreach($daftar_soal as $soal)
                   <div class="border-b py-4">
                       <p class="font-bold">{{ $soal->pertanyaan }}</p>
                       <!-- Opsi dan tombol hapus -->
                   </div>
                @endforeach
            </div>
        @else
            <!-- Tampilan untuk user (misal: pesan motivasi) -->
            <div class="bg-white p-8 rounded-3xl border text-center">
                 <p>Selamat mengerjakan kuis!</p>
            </div>
        @endif
    </div>
        </div>

    </main>
</body>
</html>