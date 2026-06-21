<x-app-layout>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('menu.index') }}" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-gray-500 hover:text-orange-500 shadow-sm transition-colors border border-gray-100">
                <i class="fa-solid fa-chevron-left text-sm"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Riwayat Pesanan</h1>
        </div>

        <!-- Tabs -->
        <div class="flex gap-3 mb-8 overflow-x-auto pb-2">
            <a href="#" class="px-6 py-2 rounded-full bg-orange-500 text-white font-semibold text-sm shadow-md whitespace-nowrap">Semua</a>
            <a href="#" class="px-6 py-2 rounded-full bg-white text-gray-500 hover:bg-gray-50 border border-gray-200 font-semibold text-sm transition-colors whitespace-nowrap">Selesai</a>
            <a href="#" class="px-6 py-2 rounded-full bg-white text-gray-500 hover:bg-gray-50 border border-gray-200 font-semibold text-sm transition-colors whitespace-nowrap">Dibatalkan</a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl mb-6 flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-green-500 text-xl"></i>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="space-y-4">
            @forelse($orders as $order)
                @php
                    $statusColor = match($order->status) {
                        'pending'   => 'text-orange-500 bg-orange-50',
                        'paid'      => 'text-blue-500 bg-blue-50',
                        'ready'     => 'text-green-500 bg-green-50',
                        'completed' => 'text-emerald-600 bg-emerald-50',
                        'cancelled' => 'text-red-500 bg-red-50',
                        default     => 'text-gray-500 bg-gray-50',
                    };
                    $statusLabel = match($order->status) {
                        'pending'   => 'Menunggu Pembayaran',
                        'paid'      => 'Diproses',
                        'ready'     => 'Siap Diambil',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                        default     => $order->status,
                    };
                @endphp
                <a href="{{ $order->status === 'pending' ? route('orders.checkout', $order->id) : route('my-orders.show', $order->id) }}" class="block bg-white p-5 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-md transition-all group">
                    <div class="flex items-center gap-5">
                        <div class="w-24 h-24 rounded-2xl overflow-hidden bg-gray-100 flex-shrink-0">
                            @if($order->food->foto)
                                <img src="{{ $order->food->foto_url }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <i class="fa-solid fa-image text-2xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="font-bold text-gray-900 truncate">Restoran Anda</h3>
                                <p class="font-bold text-gray-900">Rp{{ number_format($order->total, 0, ',', '.') }}</p>
                            </div>
                            <p class="text-sm text-gray-600 mb-2 truncate">{{ $order->food->nama }} x{{ $order->qty }}</p>
                            <p class="text-xs text-gray-400 mb-3"><i class="fa-regular fa-clock mr-1"></i> {{ $order->created_at->format('d M Y • H:i') }}</p>
                            <div class="flex justify-between items-center mt-auto">
                                <span class="px-3 py-1.5 rounded-lg text-xs font-bold {{ $statusColor }}">
                                    {{ $statusLabel }}
                                </span>
                                @if($order->status === 'pending')
                                    <span class="text-orange-500 text-sm font-bold flex items-center gap-1 group-hover:gap-2 transition-all">Lanjutkan Bayar <i class="fa-solid fa-arrow-right"></i></span>
                                @else
                                    <span class="text-gray-400 text-sm font-medium flex items-center gap-1 group-hover:text-orange-500 transition-colors">Lihat Detail <i class="fa-solid fa-chevron-right text-xs"></i></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center py-20 bg-white rounded-[2rem] border border-gray-100">
                    <div class="w-20 h-20 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-receipt text-3xl text-orange-300"></i>
                    </div>
                    <p class="text-gray-500 font-medium text-lg">Belum ada pesanan.</p>
                    <p class="text-gray-400 text-sm mt-2 mb-6">Mulai selamatkan makanan pertamamu hari ini!</p>
                    <a href="{{ route('menu.index') }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-bold py-2.5 px-6 rounded-xl transition-colors shadow-lg shadow-orange-500/30">
                        Cari Makanan
                    </a>
                </div>
            @endforelse
        </div>

    </div>

</x-app-layout>
