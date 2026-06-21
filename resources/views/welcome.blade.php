<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TimeFood') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-[2rem] shadow-xl overflow-hidden max-w-5xl w-full flex flex-col md:flex-row relative">
        
        <!-- Left Content -->
        <div class="p-10 md:p-16 flex-1 flex flex-col justify-center relative z-10">
            <!-- Logo -->
            <div class="flex items-center gap-2 mb-10">
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
            </div>

            <!-- Headline -->
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight mb-4">
                Selamatkan <br class="hidden md:block"> Makanan Layak Konsumsi, <br class="hidden md:block"> Kurangi Food Waste
            </h1>
            <p class="text-slate-600 mb-10 text-sm md:text-base max-w-sm leading-relaxed">
                TimeFood menghubungkan restoran dengan konsumen untuk menyelamatkan makanan berkualitas dengan harga terjangkau.
            </p>

            <!-- Buttons -->
            <div class="space-y-4 max-w-sm">
                <a href="{{ route('login') }}" class="block w-full text-center bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3.5 px-6 rounded-xl transition-colors shadow-lg shadow-orange-500/30">
                    Masuk Sebagai User
                </a>
                <a href="{{ route('login.restoran') }}" class="block w-full text-center bg-slate-900 hover:bg-slate-800 text-white font-semibold py-3.5 px-6 rounded-xl transition-colors shadow-lg shadow-slate-900/20">
                    Masuk Sebagai Restoran
                </a>
            </div>

            <div class="mt-8 text-sm text-slate-500">
                Belum punya akun? <a href="{{ route('register') }}" class="text-orange-500 font-semibold hover:underline">Daftar di sini</a>
            </div>
        </div>

        <!-- Right Image Area -->
        <div class="hidden md:block flex-1 relative overflow-hidden bg-orange-50">
            <!-- Orange decorative blob top-right -->
            <div class="absolute -top-20 -right-20 w-64 h-64 bg-orange-500 rounded-full mix-blend-multiply filter blur-2xl opacity-70"></div>
            <!-- Orange decorative blob bottom-left -->
            <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-orange-400 rounded-full mix-blend-multiply filter blur-2xl opacity-70"></div>
            
            <div class="absolute inset-0 flex items-center justify-center p-8">
                <div class="relative w-full aspect-square rounded-full shadow-2xl overflow-hidden border-8 border-white/50">
                    <img src="{{ asset('images/image.png') }}" alt="Delicious Food" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>

</body>
</html>
