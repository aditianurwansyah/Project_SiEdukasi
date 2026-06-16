<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mengerjakan: {{ $kuis->judul_kuis }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-700 font-sans antialiased py-10">

    <main class="max-w-3xl mx-auto px-6">
        
        <!-- Header Ujian -->
        <div class="bg-white rounded-t-3xl p-6 border-b border-slate-100 flex justify-between items-center shadow-sm sticky top-4 z-10">
            <div>
                <h1 class="text-xl font-bold text-slate-800">{{ $kuis->judul_kuis }}</h1>
                <p class="text-sm text-slate-500">Jawablah pertanyaan dengan cermat.</p>
            </div>
            <div class="bg-rose-50 text-rose-600 px-4 py-2 rounded-xl font-bold animate-pulse">
                ⏳ {{ $kuis->waktu_menit }} Menit
            </div>
        </div>

        <!-- Form Kuis -->
        <form action="{{ route('kuis.submit', $kuis->id) }}" method="POST" class="bg-white rounded-b-3xl shadow-sm p-8 space-y-10">
            @csrf
            
            <!-- Input tersembunyi untuk mencatat jumlah soal yang di-load (berguna untuk kalkulasi nilai) -->
            <input type="hidden" name="jumlah_soal_ditampilkan" value="{{ count($soal) }}">

            @foreach($soal as $index => $s)
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 mb-4">
                        <span class="text-purple-500 mr-2">{{ $index + 1 }}.</span> {{ $s->pertanyaan }}
                    </h3>
                    
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 hover:bg-purple-50 hover:border-purple-200 cursor-pointer transition">
                            <input type="radio" name="jawaban[{{ $s->id }}]" value="A" required class="w-5 h-5 text-purple-600">
                            <span class="font-medium text-slate-600">A. {{ $s->opsi_a }}</span>
                        </label>
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 hover:bg-purple-50 hover:border-purple-200 cursor-pointer transition">
                            <input type="radio" name="jawaban[{{ $s->id }}]" value="B" class="w-5 h-5 text-purple-600">
                            <span class="font-medium text-slate-600">B. {{ $s->opsi_b }}</span>
                        </label>
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 hover:bg-purple-50 hover:border-purple-200 cursor-pointer transition">
                            <input type="radio" name="jawaban[{{ $s->id }}]" value="C" class="w-5 h-5 text-purple-600">
                            <span class="font-medium text-slate-600">C. {{ $s->opsi_c }}</span>
                        </label>
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 hover:bg-purple-50 hover:border-purple-200 cursor-pointer transition">
                            <input type="radio" name="jawaban[{{ $s->id }}]" value="D" class="w-5 h-5 text-purple-600">
                            <span class="font-medium text-slate-600">D. {{ $s->opsi_d }}</span>
                        </label>
                    </div>
                </div>
            @endforeach

            <!-- Tombol Kumpulkan -->
            <div class="pt-6 border-t border-slate-100 text-center mt-8">
                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengumpulkan kuis?')" class="bg-purple-500 text-white font-bold text-lg px-12 py-4 rounded-2xl hover:bg-purple-600 hover:shadow-lg transition-all duration-300">
                    Kumpulkan Jawaban
                </button>
            </div>
        </form>

    </main>

</body>
</html>