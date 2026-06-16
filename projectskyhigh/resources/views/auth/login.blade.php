<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SiEdukasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
<body class="bg-slate-50 text-slate-700 font-sans antialiased flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-8 bg-white rounded-3xl shadow-lg opacity-0 animate-fade-up border border-slate-100">
        <div class="text-center mb-8">
            <div class="text-4xl mb-2">🎓</div>
            <h1 class="text-3xl font-extrabold text-teal-700">Selamat Datang</h1>
            <p class="text-slate-500 mt-2">Silakan login untuk melanjutkan belajar.</p>
        </div>

        <!-- Alert Jika Berhasil Register -->
        @if(session('success'))
            <div class="bg-teal-50 text-teal-600 p-4 rounded-xl mb-6 text-sm text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Alert Jika Gagal Login -->
        @error('email')
            <div class="bg-rose-50 text-rose-500 p-4 rounded-xl mb-6 text-sm text-center">
                {{ $message }}
            </div>
        @enderror

        <form action="{{ url('/login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-600 mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-teal-400 focus:border-teal-400 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-600 mb-2">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-teal-400 focus:border-teal-400 outline-none transition-all">
            </div>
            
            <button type="submit" 
                class="w-full bg-teal-500 text-white font-bold py-3 px-4 rounded-xl hover:bg-teal-600 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 mt-4">
                Masuk Sekarang
            </button>
        </form>

        <p class="text-center text-sm text-slate-500 mt-8">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="font-bold text-teal-600 hover:text-teal-500 hover:underline transition">Daftar di sini</a>
        </p>
    </div>

</body>
</html>