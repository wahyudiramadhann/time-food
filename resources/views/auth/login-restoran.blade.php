<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Restoran - TimeFood</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-900 min-h-screen flex">
    
    <!-- Left: Image Panel -->
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-slate-800">
            <!-- Pakai gambar dari Unsplash sebagai placeholder foto koki -->
            <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?q=80&w=800&auto=format&fit=crop" 
                 alt="Chef" 
                 class="absolute inset-0 w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent to-[#0F172A]"></div>
            
            <div class="absolute top-8 left-8">
                <div class="flex items-center text-2xl font-bold tracking-tight">
                    <i class="fa-solid fa-clock text-orange-500 mr-2"></i>
                    <span class="text-white">Time</span><span class="text-orange-500">Food</span>
                </div>
                <p class="text-orange-500 font-medium text-xs ml-8 mt-0.5 tracking-widest uppercase">Restoran</p>
            </div>

            <!-- Text & Tagline -->
            <div class="absolute bottom-16 left-12 right-12">
                <h2 class="text-4xl font-bold text-white leading-tight mb-4 drop-shadow-lg">
                    Kelola restoran<br>
                    <span class="text-orange-500">lebih efisien.</span>
                </h2>
                <p class="text-slate-200 text-sm leading-relaxed drop-shadow-md">
                    Platform manajemen restoran Time Food membantu Anda mengelola menu, pesanan, dan transaksi dalam satu tempat.
                </p>
                <!-- Stats -->
                <div class="flex gap-8 mt-8">
                    <div>
                        <p class="text-2xl font-bold text-white drop-shadow-md">500+</p>
                        <p class="text-slate-300 text-xs mt-1 drop-shadow-md">Restoran Aktif</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-white drop-shadow-md">12K+</p>
                        <p class="text-slate-300 text-xs mt-1 drop-shadow-md">Pesanan/Hari</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-orange-400 drop-shadow-md">98%</p>
                        <p class="text-slate-300 text-xs mt-1 drop-shadow-md">Kepuasan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 lg:p-12 bg-slate-900 relative">
            
            <div class="w-full max-w-md">
                <div class="lg:hidden mb-8 flex items-center justify-center text-2xl font-bold tracking-tight">
                <i class="fa-solid fa-clock text-orange-500 mr-2"></i>
                <span class="text-white">Time</span><span class="text-orange-500">Food</span>
            </div>

            <div class="mb-8">
                <h1 class="text-2xl font-bold text-white mb-2">Login Restoran</h1>
                <p class="text-slate-400 text-sm">Masuk untuk mengelola restoran Anda</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 text-sm text-green-400">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full bg-slate-800/50 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                        placeholder="Masukkan email">
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" required
                            class="w-full bg-slate-800/50 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-3 pr-10 text-sm focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                            placeholder="Masukkan password">
                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-300">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center justify-between mt-2">
                    <div class="flex items-center gap-2 text-sm text-slate-400 cursor-pointer">
                        {{-- Ini kosongin aja sengaja atau kasih Remember Me hidden biar layout rapi seperti mockup --}}
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-slate-400 hover:text-orange-400 transition-colors">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-xl transition-colors text-sm mt-4 shadow-lg shadow-orange-500/20">
                    Login
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-slate-400 text-sm">
                    Belum punya akun?
                    <a href="{{ route('register.restoran') }}" class="text-orange-500 hover:text-orange-400 font-medium ml-1">Daftar di sini</a>
                </p>
            </div>
            
            <p class="text-center mt-6">
                <a href="{{ route('login') }}" class="text-slate-500 text-xs hover:text-slate-400">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Login Customer
                </a>
            </p>
            </div>
        </div>
    </div>
</body>
</html>
