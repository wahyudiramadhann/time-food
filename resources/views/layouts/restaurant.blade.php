<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TimeFood') }} - Restoran</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100 flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-60 bg-slate-900 text-white flex flex-col flex-shrink-0 hidden md:flex">
        <!-- Logo -->
        <div class="h-16 flex items-center px-5 border-b border-slate-800">
            <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54 54" class="w-7 h-7 flex-shrink-0">
                    <circle cx="27" cy="27" r="23" fill="none" stroke="white" stroke-width="3"/>
                    <circle cx="27" cy="27" r="2.5" fill="#F97316"/>
                    <circle cx="27" cy="7" r="2" fill="#F97316"/>
                    <circle cx="47" cy="27" r="2" fill="#F97316"/>
                    <circle cx="27" cy="47" r="2" fill="#F97316"/>
                    <circle cx="7" cy="27" r="2" fill="#F97316"/>
                    <line x1="27" y1="27" x2="16" y2="12" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
                    <g transform="translate(27,27) rotate(50)">
                        <line x1="0" y1="0" x2="0" y2="-17" stroke="#F97316" stroke-width="2.5" stroke-linecap="round"/>
                        <line x1="-3.5" y1="-17" x2="-3.5" y2="-24" stroke="#F97316" stroke-width="1.8" stroke-linecap="round"/>
                        <line x1="0" y1="-17" x2="0" y2="-24" stroke="#F97316" stroke-width="1.8" stroke-linecap="round"/>
                        <line x1="3.5" y1="-17" x2="3.5" y2="-24" stroke="#F97316" stroke-width="1.8" stroke-linecap="round"/>
                    </g>
                </svg>
                <div class="flex items-baseline ml-1.5">
                    <span class="text-base font-black text-white leading-none">Time</span><span class="text-base font-black text-orange-500 leading-none">Food</span>
                </div>
            </div>
        </div>
        <!-- Nav -->
        <nav class="flex-1 px-3 py-5 space-y-1">
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
               {{ request()->routeIs('dashboard') ? 'bg-orange-500 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-gauge-high w-4 text-center text-sm"></i>
                Dashboard
            </a>
            <a href="{{ route('foods.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
               {{ request()->routeIs('foods.*') ? 'bg-orange-500 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-utensils w-4 text-center text-sm"></i>
                Kelola Makanan
            </a>
            <a href="{{ route('orders.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
               {{ request()->routeIs('orders.*') ? 'bg-orange-500 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-clipboard-list w-4 text-center text-sm"></i>
                Pesanan Masuk
            </a>
            <a href="{{ route('transaksi.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
               {{ request()->routeIs('transaksi.*') ? 'bg-orange-500 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-clock-rotate-left w-4 text-center text-sm"></i>
                Transaksi
            </a>
            <a href="{{ route('pengaturan.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
               {{ request()->routeIs('pengaturan.*') ? 'bg-orange-500 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-gear w-4 text-center text-sm"></i>
                Pengaturan
            </a>
        </nav>
        <!-- Logout -->
        <div class="p-3 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="button" onclick="confirmLogout()"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-white transition-colors">
                    <i class="fa-solid fa-right-from-bracket w-4 text-center text-sm"></i>
                    Keluar
                </button>
            </form>
        </div>
    </aside>
    <!-- Main -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Topbar -->
        <header class="h-16 bg-white border-b border-slate-100 flex items-center justify-between px-6 flex-shrink-0" x-data="{ profileDropdownOpen: false }">
            <div class="md:hidden">
                <span class="text-base font-black text-slate-800 leading-none">Time<span class="text-orange-500">Food</span></span>
            </div>
            <div class="hidden md:flex items-center gap-2 text-sm text-slate-500">
                <i class="fa-solid fa-circle-dot text-orange-500 text-xs"></i>
                Panel Restoran
            </div>
            
            <!-- Right Actions & Profile Dropdown -->
            <div class="flex items-center gap-4 relative">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold text-slate-800">{{ auth()->user()->name ?? 'Restoran' }}</p>
                    <p class="text-xs text-slate-400">Pemilik Restoran</p>
                </div>
                
                <button @click="profileDropdownOpen = !profileDropdownOpen" @click.away="profileDropdownOpen = false" class="flex items-center focus:outline-none transition-transform hover:scale-105">
                    @if(auth()->user()->foto)
                        <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                            class="w-10 h-10 rounded-full object-cover border-2 border-orange-200 shadow-sm" alt="Foto Restoran">
                    @else
                        <div class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold text-sm shadow-sm border-2 border-white">
                            {{ substr(auth()->user()->name ?? 'R', 0, 1) }}
                        </div>
                    @endif
                </button>

                <!-- Profile Dropdown Menu -->
                <div x-show="profileDropdownOpen" x-transition x-cloak class="absolute right-0 top-12 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50">
                    <div class="px-4 py-3 border-b border-slate-100 mb-2">
                        <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                    </div>
                    <a href="{{ route('pengaturan.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                        <i class="fa-solid fa-gear w-4 text-center"></i> Pengaturan
                    </a>
                    <div class="border-t border-slate-100 my-2"></div>
                    <form method="POST" action="{{ route('logout') }}" id="dropdown-logout-form">
                        @csrf
                        <button type="button" onclick="confirmLogout()" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                            <i class="fa-solid fa-right-from-bracket w-4 text-center"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </header>
        <!-- Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-100 p-6">
            @yield('content')
        </main>
    </div>

    <!-- Scripts Khusus Layout -->
    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Yakin ingin keluar?',
                text: "Sesi Anda akan diakhiri.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f97316', // orange-500
                cancelButtonColor: '#64748b', // slate-500
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal',
                background: '#ffffff',
                customClass: {
                    title: 'text-slate-800 font-bold',
                    htmlContainer: 'text-slate-500'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            })
        }
    </script>
</body>
</html>
