<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - SiEdukasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animasi Keren & Lembut */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up {
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
    </style>
</head>
<body class="bg-slate-50 text-slate-700 font-sans antialiased selection:bg-teal-200">

    <nav class="bg-white shadow-sm px-6 py-4 flex justify-between items-center sticky top-0 z-50">
        <div class="text-2xl font-bold text-teal-600">SiEdukasi</div>
        <div class="flex gap-6 items-center">
            <a href="{{ route('dashboard') }}" class="hover:text-teal-500 transition">Beranda</a>
            <a href="{{ route('materi.index') }}" class="hover:text-teal-500 transition">Materi</a>
            <a href="{{ route('kuis.index') }}" class="hover:text-teal-500 transition">Kuis</a>
            <a href="{{ route('tentang') }}" class="hover:text-teal-500 transition">Tentang</a>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-rose-100 text-rose-600 px-4 py-2 rounded-full hover:bg-rose-200 transition shadow-sm">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto mt-12 px-6">
        <div class="bg-teal-50 rounded-3xl p-10 text-center shadow-sm opacity-0 animate-fade-up">
            <h1 class="text-4xl font-extrabold text-teal-800 mb-4">
                Selamat Datang, {{ Auth::user()->name }}! ✨
            </h1>
            <p class="text-lg text-teal-600/80 max-w-2xl mx-auto">
                {{ Auth::user()->role == 'admin' ? 'Ini adalah panel monitoring Admin. Anda bisa mengelola materi dan kuis.' : 'Mari mulai petualangan belajarmu hari ini dengan materi yang menyenangkan.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
            
            <a href="{{ route('materi.index') }}" class="group bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 opacity-0 animate-fade-up delay-100">
                <div class="w-16 h-16 bg-blue-100 text-blue-500 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition">
                    📚
                </div>
                <h2 class="text-2xl font-bold text-slate-800 mb-2">Materi Pembelajaran</h2>
                <p class="text-slate-500">Jelajahi berbagai modul pembelajaran..</p>
            </a>

            <a href="{{ route('kuis.index') }}" class="group bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 opacity-0 animate-fade-up delay-200">
                <div class="w-16 h-16 bg-purple-100 text-purple-500 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition">
                    🎯
                </div>
                <h2 class="text-2xl font-bold text-slate-800 mb-2">Kuis Interaktif</h2>
                <p class="text-slate-500">Uji pengetahuanmu dengan fitur kuis. Dari kesesuaian dalam pemahaman hingga kecepatan penyelesaian soal.</p>
            </a>

        </div>
    </main>
</body>
</html>