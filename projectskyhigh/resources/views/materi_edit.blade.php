<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Materi - SiEdukasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-700 font-sans antialiased flex items-center justify-center min-h-screen py-10">

    <div class="w-full max-w-2xl bg-white p-8 rounded-3xl shadow-lg border border-slate-100 mx-4">
        <h1 class="text-2xl font-bold text-slate-800 mb-2">✏️ Edit Materi</h1>
        <p class="text-slate-500 mb-6 text-sm">Ganti konten pembelajaran yang sudah ada.</p>

        <form action="{{ route('materi.update', $materi->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-semibold text-slate-600 mb-2">Judul Materi</label>
                <input type="text" name="judul" value="{{ $materi->judul }}" required
                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-teal-400 focus:border-teal-400 outline-none transition-all">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-600 mb-2">Ringkasan Deskripsi</label>
                <textarea name="deskripsi" rows="3" required
                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-teal-400 focus:border-teal-400 outline-none transition-all">{{ $materi->deskripsi }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-600 mb-2">Konten Detail Materi</label>
                <textarea name="konten_materi" rows="6" required
                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-teal-400 focus:border-teal-400 outline-none transition-all">{{ $materi->konten_materi }}</textarea>
            </div>

            <div class="flex gap-4 pt-4">
                <a href="{{ route('materi.index') }}" class="w-1/2 bg-slate-100 text-slate-600 text-center font-bold py-3 px-4 rounded-xl hover:bg-slate-200 transition">
                    Batal
                </a>
                <button type="submit" class="w-1/2 bg-teal-500 text-white font-bold py-3 px-4 rounded-xl hover:bg-teal-600 hover:shadow-md transition">
                    Perbarui Materi
                </button>
            </div>
        </form>
    </div>

</body>
</html>