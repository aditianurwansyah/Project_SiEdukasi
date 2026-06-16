<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $materi->judul }} - SiEdukasi</title>
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
        <div class="text-2xl font-bold text-teal-600">EdukasiApp 🎓</div>
        <div class="flex gap-6 items-center">
            <a href="{{ route('dashboard') }}" class="hover:text-teal-500 transition">Beranda</a>
            <a href="{{ route('materi.index') }}" class="font-bold text-teal-600 border-b-2 border-teal-500 pb-1">Materi</a>
            <a href="{{ route('kuis.index') }}" class="hover:text-teal-500 transition">Kuis</a>
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
    <main class="max-w-4xl mx-auto mt-10 px-6 mb-20 opacity-0 animate-fade-up">
        
        <!-- Tombol Kembali -->
        <a href="{{ route('materi.index') }}" class="inline-flex items-center gap-2 text-teal-600 hover:text-teal-500 font-semibold mb-6 transition-all duration-300 hover:-translate-x-1">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Materi
        </a>

        <!-- Kartu Materi Detail -->
        <article class="bg-white rounded-3xl p-8 md:p-12 border border-slate-100 shadow-sm">
            <div class="flex items-center gap-3 text-xs bg-teal-50 text-teal-700 px-4 py-2 rounded-full font-semibold w-fit mb-6">
                <i class="fa-solid fa-book-open"></i> Modul Pembelajaran Aktif
            </div>

            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-4 leading-tight">
                {{ $materi->judul }}
            </h1>

            <div class="flex items-center gap-4 text-sm text-slate-400 border-b border-slate-100 pb-6 mb-8">
                <span><i class="fa-solid fa-calendar-days mr-1"></i> {{ $materi->created_at->format('d M Y') }}</span>
                <span>•</span>
                <span><i class="fa-solid fa-user mr-1"></i> Ditulis oleh Admin</span>
            </div>

            <!-- Ringkasan Deskripsi -->
            <div class="bg-slate-50 border-l-4 border-teal-400 p-4 rounded-r-2xl mb-8">
                <p class="text-sm font-medium text-slate-500 italic">
                    "{{ $materi->deskripsi }}"
                </p>
            </div>

            <!-- Konten Utama Materi (Mendukung Teks Paragraf) -->
            <div class="prose max-w-none text-slate-600 leading-relaxed space-y-6 text-base md:text-lg whitespace-pre-line">
                {{ $materi->konten_materi }}
            </div>
        </article>

    </main>

</body>
</html>