<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - SiEdukasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-fade-scale { animation: fadeInScale 0.8s ease-out forwards; }
    </style>
</head>
<body class="bg-slate-50 text-slate-700 font-sans antialiased">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm px-6 py-4 flex justify-between items-center sticky top-0 z-50">
        <div class="text-2xl font-bold text-teal-600">SiEdukasi</div>
        <div class="flex gap-6 items-center">
            <a href="/dashboard" class="hover:text-teal-500 transition">Beranda</a>
            <a href="/materi" class="hover:text-teal-500 transition">Materi</a>
            <a href="/kuis" class="hover:text-teal-500 transition">Kuis</a>
            <a href="/tentang" class="text-teal-600 font-semibold border-b-2 border-teal-500">Tentang</a>
            <!-- Tombol Logout -->
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="bg-rose-100 text-rose-600 px-4 py-2 rounded-full hover:bg-rose-200 transition shadow-sm">Logout</button>
            </form>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto mt-16 px-6 animate-fade-scale text-center">
        <div class="w-24 h-24 bg-teal-100 text-teal-500 rounded-3xl mx-auto flex items-center justify-center text-5xl mb-6 shadow-sm">
            💡
        </div>
        <h1 class="text-4xl font-bold text-slate-800 mb-4">Tentang Platform Edukasi</h1>
        <p class="text-lg text-slate-500 leading-relaxed mb-10">
            SiEdukasi dibangun menggunakan Laravel 10 dan MySQL dengan visi menciptakan ruang belajar digital yang <span class="font-bold text-teal-600">kalem, estetis, dan menyenangkan</span>. Kami percaya bahwa desain UI/UX yang baik dipadukan dengan animasi lembut dapat meningkatkan fokus dan kenyamanan penggunanya.
        </p>

        <div class="bg-white p-8 rounded-3xl shadow-sm text-left grid grid-cols-1 md:grid-cols-2 gap-8 items-center border border-slate-100">
            <div>
                <h3 class="text-2xl font-bold text-slate-800 mb-3">Teknologi yang Digunakan</h3>
                <ul class="space-y-3 text-slate-600">
                    <li class="flex items-center gap-3"><span class="w-8 h-8 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center">⚙️</span> Laravel 10 (Backend & Routing)</li>
                    <li class="flex items-center gap-3"><span class="w-8 h-8 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center">💾</span> MySQL Database (Persistensi Data)</li>
                    <li class="flex items-center gap-3"><span class="w-8 h-8 rounded-full bg-teal-50 text-teal-500 flex items-center justify-center">🎨</span> Tailwind CSS (UI Kalem Pastel)</li>
                    <li class="flex items-center gap-3"><span class="w-8 h-8 rounded-full bg-purple-50 text-purple-500 flex items-center justify-center">✨</span> Custom CSS (Animasi Halus)</li>
                </ul>
            </div>
            <div class="bg-slate-50 rounded-2xl h-48 flex items-center justify-center text-slate-400">
                (Area untuk Gambar/Ilustrasi Tambahan)
            </div>
        </div>
    </main>
</body>
</html>