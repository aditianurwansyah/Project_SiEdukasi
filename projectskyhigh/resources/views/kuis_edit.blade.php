<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kuis - SiEdukasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-700 font-sans antialiased flex items-center justify-center min-h-screen py-10">

    <div class="w-full max-w-2xl bg-white p-8 rounded-3xl shadow-lg border border-slate-100 mx-4">
        <h1 class="text-2xl font-bold text-slate-800 mb-2">✏️ Edit Kuis</h1>
        <p class="text-slate-500 mb-6 text-sm">Ubah detail data kuis evaluasi.</p>

        <form action="{{ route('kuis.update', $kuis->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-semibold text-slate-600 mb-2">Judul Kuis</label>
                <input type="text" name="judul_kuis" value="{{ $kuis->judul_kuis }}" required
                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-purple-400 focus:border-purple-400 outline-none transition-all">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-600 mb-2">Deskripsi Kuis</label>
                <textarea name="deskripsi_kuis" rows="3" required
                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-purple-400 focus:border-purple-400 outline-none transition-all">{{ $kuis->deskripsi_kuis }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-2">Jumlah Soal</label>
                    <input type="number" name="jumlah_soal" value="{{ $kuis->jumlah_soal }}" required min="1"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-purple-400 focus:border-purple-400 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-2">Batas Waktu (Menit)</label>
                    <input type="number" name="waktu_menit" value="{{ $kuis->waktu_menit }}" required min="1"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-purple-400 focus:border-purple-400 outline-none transition-all">
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <a href="{{ route('kuis.index') }}" class="w-1/2 bg-slate-100 text-slate-600 text-center font-bold py-3 px-4 rounded-xl hover:bg-slate-200 transition">
                    Batal
                </a>
                <button type="submit" class="w-1/2 bg-purple-500 text-white font-bold py-3 px-4 rounded-xl hover:bg-purple-600 hover:shadow-md transition">
                    Perbarui Kuis
                </button>
            </div>
        </form>
    </div>

</body>
</html>