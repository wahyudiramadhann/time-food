<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Restoran - TimeFood</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-900 min-h-screen flex">
    
    <!-- Left: Image Panel -->
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-slate-800">
            <!-- Pakai gambar dari Unsplash sebagai placeholder foto bahan makanan/resto -->
            <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?q=80&w=800&auto=format&fit=crop" 
                 alt="Restaurant" 
                 class="absolute inset-0 w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent to-[#0F172A]"></div>
            
            <div class="absolute top-8 left-8">
                <div class="flex items-center text-2xl font-bold tracking-tight">
                    <i class="fa-solid fa-clock text-orange-500 mr-2"></i>
                    <span class="text-white">Time</span><span class="text-orange-500">Food</span>
                </div>
                <p class="text-orange-500 font-medium text-xs ml-8 mt-0.5 tracking-widest uppercase">Restoran</p>
            </div>
            
            <!-- Benefit Text -->
            <div class="absolute bottom-12 left-12 right-12">
                <h2 class="text-4xl font-bold text-white leading-tight mb-4 drop-shadow-lg">
                    Gabung bersama<br>
                    <span class="text-orange-500">Time Food.</span>
                </h2>
                <p class="text-slate-300 text-sm leading-relaxed mb-6">
                    Mulai kelola sisa makanan restoran Anda dengan lebih efisien, kurangi food waste, dan dapatkan keuntungan tambahan.
                </p>
                <div class="space-y-4">
                    <div class="flex items-center gap-3 text-slate-200 text-sm font-medium drop-shadow-md">
                        <i class="fa-solid fa-check-circle text-orange-500"></i> Platform mudah digunakan
                    </div>
                    <div class="flex items-center gap-3 text-slate-200 text-sm font-medium drop-shadow-md">
                        <i class="fa-solid fa-check-circle text-orange-500"></i> Dukungan penuh untuk partner
                    </div>
                    <div class="flex items-center gap-3 text-slate-200 text-sm font-medium drop-shadow-md">
                        <i class="fa-solid fa-check-circle text-orange-500"></i> Jangkau lebih banyak pelanggan
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
            
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-white mb-2">Daftar Restoran</h1>
                <p class="text-slate-400 text-sm">Buat akun untuk mengelola restoran Anda</p>
            </div>
            
            <form method="POST" action="{{ route('register.restoran') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1.5">Nama Restoran</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full bg-slate-800/50 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                        placeholder="Nama Restoran Anda">
                    @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full bg-slate-800/50 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                        placeholder="email@restoran.com">
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1.5">Password</label>
                    <input type="password" name="password" required
                        class="w-full bg-slate-800/50 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                        placeholder="Minimal 8 karakter">
                    @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full bg-slate-800/50 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                        placeholder="Ketik ulang password">
                </div>
                
                <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-xl transition-colors text-sm mt-6 shadow-lg shadow-orange-500/20">
                    Daftar Sekarang
                </button>
            </form>
            
            <div class="mt-8 text-center">
                <p class="text-slate-400 text-sm">
                    Sudah punya akun?
                    <a href="{{ route('login.restoran') }}" class="text-orange-500 hover:text-orange-400 font-medium ml-1">Login di sini</a>
                </p>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
