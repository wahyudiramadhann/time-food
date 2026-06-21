<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TimeFood') }} - Lupa Password</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-[2rem] shadow-xl overflow-hidden max-w-md w-full relative">
        <div class="p-8 sm:p-12">
            <!-- Logo -->
            <div class="flex justify-center mb-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54 54" class="w-10 h-10 flex-shrink-0">
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
                </a>
            </div>

            <h2 class="text-2xl font-bold text-center text-slate-800 mb-2">Lupa Password?</h2>
            
            <div class="mb-6 text-sm text-slate-500 text-center leading-relaxed">
                {{ __('Jangan khawatir. Masukkan email kamu dan kami akan mengirimkan tautan untuk membuat password baru.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-center font-medium text-sm text-green-600" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Terdaftar</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-orange-500 focus:ring-orange-500 transition-colors bg-slate-50 text-slate-800 text-center">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-center" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3.5 px-4 rounded-xl transition-colors shadow-lg shadow-orange-500/30">
                        {{ __('Kirim Link Reset Password') }}
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('login') }}" class="text-sm text-slate-500 hover:text-orange-500 font-medium flex items-center justify-center gap-2 transition-colors">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Login
                </a>
            </div>
        </div>
    </div>

</body>
</html>
