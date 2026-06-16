<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Soal - {{ $kuis->judul_kuis }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-700 py-10">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-3xl shadow-lg border border-slate-100 mx-4">
        <h1 class="text-2xl font-bold mb-1 text-slate-800">➕ Tambah Pertanyaan Baru</h1>
        <p class="text-slate-500 mb-6 text-sm">Menambahkan butir pertanyaan ke kuis: <strong class="text-purple-600">{{ $kuis->judul_kuis }}</strong></p>

        <form action="{{ route('soal.store', $kuis->id) }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-slate-600 mb-2">Pertanyaan</label>
                <textarea name="pertanyaan" required rows="4" placeholder="Ketik pertanyaan kuis di sini..."
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-400 outline-none transition-all"></textarea>
            </div>

            <div class="space-y-4">
                <h3 class="text-sm font-bold text-slate-600 border-b border-slate-100 pb-2">Opsi Jawaban Pilihan Ganda</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5">Pilihan A</label>
                        <input type="text" name="opsi_a" required placeholder="Jawaban Opsi A"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-400 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5">Pilihan B</label>
                        <input type="text" name="opsi_b" required placeholder="Jawaban Opsi B"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-400 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5">Pilihan C</label>
                        <input type="text" name="opsi_c" required placeholder="Jawaban Opsi C"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-400 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5">Pilihan D</label>
                        <input type="text" name="opsi_d" required placeholder="Jawaban Opsi D"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-purple-400 outline-none transition-all">
                    </div>
                </div>
            </div>

            <div class="bg-purple-50 p-6 rounded-2xl border border-purple-100 mt-6">
                <label class="block text-sm font-bold text-purple-700 mb-2">
                    <i class="fa-solid fa-key"></i> Tentukan Kunci Jawaban Benar
                </label>
                <select name="jawaban_benar" required 
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none focus:ring-2 focus:ring-purple-400 bg-white transition-all">
                    <option value="A">Opsi A</option>
                    <option value="B">Opsi B</option>
                    <option value="C">Opsi C</option>
                    <option value="D">Opsi D</option>
                </select>
            </div>

            <div class="flex gap-4 pt-4">
                <a href="{{ route('kuis.show', $kuis->id) }}" class="w-1/3 bg-slate-100 text-slate-600 text-center font-bold py-3.5 rounded-xl hover:bg-slate-200 transition">
                    Batal
                </a>
                <button type="submit" class="w-2/3 bg-purple-500 text-white font-bold py-3.5 rounded-xl hover:bg-purple-600 hover:shadow-md transition">
                    Simpan Pertanyaan
                </button>
            </div>
        </form>
    </div>

</body>
</html>