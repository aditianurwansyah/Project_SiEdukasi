<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuis Evaluasi - SiEdukasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up {
            animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
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
            <a href="{{ route('tentang') }}" class="hover:text-teal-500 transition">Tentang</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-rose-100 text-rose-600 px-4 py-2 rounded-full hover:bg-rose-200 transition text-sm font-semibold">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="max-w-6xl mx-auto mt-10 px-6 mb-20">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 opacity-0 animate-fade-up">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800">Kuis Evaluasi Belajar 🎯</h1>
                <p class="text-slate-500 mt-1">Uji pemahaman belajarmu dengan kuis seru berdurasi.</p>
            </div>
            
            <!-- Tombol Tambah Kuis (Hanya Terlihat Oleh Admin) -->
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('kuis.create') }}" 
                   class="bg-purple-500 text-white font-semibold px-5 py-3 rounded-2xl hover:bg-purple-600 transition shadow-md hover:shadow-lg flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Tambah Kuis Baru
                </a>
            @endif
        </div>

        <!-- Alert Notifikasi -->
        @if(session('success'))
            <div class="bg-purple-50 border border-purple-200 text-purple-700 p-4 rounded-2xl mb-6 flex items-center gap-2 opacity-0 animate-fade-up">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Grid List Kuis -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($kuis as $k)
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between opacity-0 animate-fade-up">
                    <div>
                        <div class="w-12 h-12 bg-purple-50 text-purple-500 rounded-xl flex items-center justify-center text-xl mb-4">
                            ⭐
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">{{ $k->judul_kuis }}</h3>
                        <p class="text-slate-500 text-sm line-clamp-3 mb-4">{{ $k->deskripsi_kuis }}</p>
                        
                        <div class="flex gap-4 mt-2">
                            <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1.5 rounded-full font-medium">
                                <i class="fa-solid fa-list-check mr-1"></i> Buka {{ $k->jumlah_soal }} Soal
                            </span>
                            <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1.5 rounded-full font-medium">
                                <i class="fa-solid fa-clock mr-1"></i> {{ $k->waktu_menit }} Menit
                            </span>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 pt-4 flex justify-between items-center mt-6">
                        <span class="text-xs text-slate-400">Dibuat: {{ $k->created_at->format('d M Y') }}</span>
                        
                        <div class="flex gap-2">
                            <!-- Hak Akses Khusus Admin -->
                            @if(Auth::user()->role === 'admin')
                                <!-- TOMBOL BARU: Kelola Soal (Masuk ke Detail Kuis) -->
                                <a href="{{ route('kuis.show', $k->id) }}" class="bg-purple-50 text-purple-600 p-2 rounded-xl hover:bg-purple-100 transition" title="Kelola Bank Soal">
                                    <i class="fa-solid fa-folder-open"></i>
                                </a>

                                <a href="{{ route('kuis.edit', $k->id) }}" class="bg-amber-50 text-amber-600 p-2 rounded-xl hover:bg-amber-100 transition" title="Edit Kuis">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('kuis.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kuis ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-rose-50 text-rose-600 p-2 rounded-xl hover:bg-rose-100 transition" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            @else
                                <!-- Tombol Mulai Kuis untuk User -->
                                <a href="{{ route('kuis.show', $k->id) }}" class="bg-purple-50 text-purple-600 px-4 py-2 rounded-xl hover:bg-purple-100 transition text-sm font-semibold">
                                    Mulai Kuis
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-slate-100 rounded-3xl p-12 text-center text-slate-500 opacity-0 animate-fade-up">
                    <p class="text-xl font-semibold mb-2">Kuis belum tersedia</p>
                    <p class="text-sm">Silakan klik tombol "Tambah Kuis Baru" di atas untuk menyiapkan evaluasi kuis pertama Anda.</p>
                </div>
            @endforelse
        </div>

    </main>

</body>
</html>