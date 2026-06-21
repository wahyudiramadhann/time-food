<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TimeFood') }} - Masuk Customer</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-[2rem] shadow-xl overflow-hidden max-w-4xl w-full flex flex-col md:flex-row relative">
        
        <!-- Left Content (Form) -->
        <div class="p-8 md:p-12 flex-1 flex flex-col justify-center relative z-10">
            <!-- Logo -->
            <div class="flex items-center gap-2 mb-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54 54" class="w-8 h-8 flex-shrink-0">
                        <circle cx="27" cy="27" r="23" fill="none" stroke="#1E293B" stroke-width="3"/>
                        <circle cx="27" cy="27" r="2.5" fill="#F97316"/>
                        <circle cx="27" cy="7" r="2" fill="#F97316"/>
                        <circle cx="47" cy="27" r="2" fill="#F97316"/>
                        <circle cx="27" cy="47" r="2" fill="#F97316"/>
                        <circle cx="7" cy="27" r="2" fill="#F97316"/>
                        <line x1="27" y1="27" x2="16" y2="12" stroke="#1E293B" stroke-width="2.5" stroke-linecap="round"/>
                        <g transform="translate(27,27) rotate(50)">
                            <line x1="0" y1="0" x2="0" y2="-17" stroke="#F97316" stroke-width="2.5" stroke-linecap="round"/>
                            <line x1="-3.5" y1="-17" x2="-3.5" y2="-24" stroke="#F97316" stroke-width="1.8" stroke-linecap="round"/>
                            <line x1="0" y1="-17" x2="0" y2="-24" stroke="#F97316" stroke-width="1.8" stroke-linecap="round"/>
                            <line x1="3.5" y1="-17" x2="3.5" y2="-24" stroke="#F97316" stroke-width="1.8" stroke-linecap="round"/>
                        </g>
                    </svg>
                    <span class="text-xl font-black text-slate-800 tracking-tight">Time<span class="text-orange-500">Food</span></span>
                </a>
            </div>

            <h2 class="text-2xl font-bold text-slate-800 mb-2">Selamat Datang Kembali! 👋</h2>
            <p class="text-slate-500 text-sm mb-8">Masuk ke akunmu untuk mencari makanan murah hari ini.</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-green-600 font-medium" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-orange-500 focus:ring-orange-500 transition-colors bg-slate-50 text-slate-800">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-orange-500 focus:ring-orange-500 transition-colors bg-slate-50 text-slate-800">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-orange-500 focus:ring-orange-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm font-semibold text-orange-500 hover:underline" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3.5 px-4 rounded-xl transition-colors shadow-lg shadow-orange-500/30">
                        Masuk
                    </button>
                </div>

                <p class="text-center text-sm text-slate-500 mt-6">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-orange-500 font-semibold hover:underline">Daftar sekarang</a>
                </p>
                
                <p class="text-center text-xs text-slate-400 mt-2">
                    <a href="{{ route('login.restoran') }}" class="hover:text-slate-600 hover:underline">Login sebagai Restoran</a>
                </p>
            </form>
        </div>

        <!-- Right Image Area -->
        <div class="hidden md:block w-5/12 relative overflow-hidden bg-orange-100">
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1473093295043-cdd812d0e601?q=80&w=2070&auto=format&fit=crop');"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-orange-900/80 to-orange-900/10"></div>
            
            <div class="absolute bottom-0 left-0 right-0 p-10 text-white">
                <h3 class="text-2xl font-bold mb-2">Penyelamat Bumi!</h3>
                <p class="text-orange-100 text-sm">Masuk sekarang dan nikmati ratusan porsi makanan lezat dengan harga sangat terjangkau.</p>
            </div>
        </div>
    </div>

</body>
</html>
