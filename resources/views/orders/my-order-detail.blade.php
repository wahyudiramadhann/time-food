<x-app-layout>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="flex justify-between items-center mb-8">
            <a href="{{ route('my-orders.index') }}" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-gray-500 hover:text-orange-500 shadow-sm transition-colors border border-gray-100">
                <i class="fa-solid fa-chevron-left text-sm"></i>
            </a>
            <h1 class="text-xl font-bold text-gray-900">Detail Pemesanan</h1>
            <div class="w-10"></div> <!-- Spacer for centering -->
        </div>

        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 mb-6">
            <h2 class="text-lg font-bold text-gray-900 mb-8">Pesanan #{{ $order->pickup_code }}</h2>

            <!-- Timeline -->
            @php
                $statusSteps = ['pending', 'paid', 'ready', 'completed'];
                $currentIndex = array_search($order->status, $statusSteps);
                if ($order->status === 'cancelled') $currentIndex = -1;
            @endphp
            
            <div class="relative flex justify-between items-center mb-12">
                <!-- Line -->
                <div class="absolute top-5 left-[10%] right-[10%] h-0.5 bg-gray-200 -z-10"></div>
                @if($currentIndex > 0)
                    @php $progress = min(100, ($currentIndex / 3) * 100); @endphp
                    <div class="absolute top-5 left-[10%] h-0.5 bg-orange-500 -z-10 transition-all duration-1000" style="width: {{ $progress - 10 }}%"></div>
                @endif

                <!-- Steps -->
                @foreach([
                    ['key' => 'pending', 'label' => 'Menunggu Pembayaran', 'icon' => 'fa-wallet'],
                    ['key' => 'paid', 'label' => 'Diproses', 'icon' => 'fa-fire-burner'],
                    ['key' => 'ready', 'label' => 'Siap Diambil', 'icon' => 'fa-bag-shopping'],
                    ['key' => 'completed', 'label' => 'Selesai', 'icon' => 'fa-check-double'],
                ] as $index => $step)
                    @php
                        $isCompleted = $currentIndex >= $index;
                        $isCurrent = $currentIndex === $index;
                    @endphp
                    <div class="flex flex-col items-center relative">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 mb-2 bg-white transition-colors duration-500 {{ $isCompleted ? 'border-orange-500 text-orange-500' : 'border-gray-200 text-gray-300' }} {{ $isCurrent ? 'ring-4 ring-orange-50' : '' }}">
                            <i class="fa-solid {{ $step['icon'] }} text-sm"></i>
                        </div>
                        <span class="text-[10px] font-bold text-center w-16 {{ $isCompleted ? 'text-gray-800' : 'text-gray-400' }}">{{ $step['label'] }}</span>
                    </div>
                @endforeach
            </div>

            <!-- QR Code Section (Only if Ready or Paid) -->
            @if(in_array($order->status, ['paid', 'ready']))
                <div class="text-center mb-10 pb-10 border-b border-gray-100">
                    @if($order->status === 'ready')
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Pesanan siap diambil!</h3>
                        <p class="text-sm text-gray-500 mb-8 max-w-xs mx-auto">Tunjukkan QR Code ini ke restoran saat pengambilan pesanan.</p>
                    @else
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Pesanan sedang diproses</h3>
                        <p class="text-sm text-gray-500 mb-8 max-w-xs mx-auto">QR Code akan digunakan saat pesanan sudah siap diambil.</p>
                    @endif
                    
                    <div class="inline-block p-4 bg-white border-2 border-gray-100 rounded-3xl shadow-sm mb-6">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ $order->pickup_code }}&margin=0" alt="QR Code" class="w-48 h-48 opacity-{{ $order->status === 'ready' ? '100' : '50' }}">
                    </div>

                    <div class="flex justify-center items-center gap-4 text-sm">
                        <span class="text-gray-500 font-medium">Kode Pengambilan</span>
                        <span class="font-bold text-orange-500 text-xl tracking-widest bg-orange-50 px-4 py-1.5 rounded-lg">{{ $order->pickup_code }}</span>
                    </div>
                </div>
            @endif

            <!-- Info Restoran & Order -->
            <div class="space-y-4 text-sm">
                <div class="flex justify-between items-start">
                    <span class="text-gray-500">Restoran</span>
                    <div class="text-right">
                        <p class="font-bold text-gray-800">Restoran Anda</p>
                        <a href="#" class="text-orange-500 font-semibold hover:underline text-xs">Lihat Lokasi</a>
                    </div>
                </div>
                <div class="flex justify-between items-start">
                    <span class="text-gray-500">Alamat</span>
                    <p class="font-medium text-gray-800 text-right w-1/2">{{ $order->food->alamat }}</p>
                </div>
                <div class="flex justify-between items-start">
                    <span class="text-gray-500">Jam Pengambilan</span>
                    <p class="font-medium text-gray-800 text-right">Hari ini, {{ $order->food->pickup_time_start ? date('H:i', strtotime($order->food->pickup_time_start)) : '00:00' }} - {{ $order->food->pickup_time_end ? date('H:i', strtotime($order->food->pickup_time_end)) : '23:59' }}</p>
                </div>
            </div>

            @if($order->status !== 'completed' && $order->status !== 'cancelled')
                <div class="mt-8">
                    <a href="#" class="block w-full text-center border-2 border-orange-500 text-orange-500 hover:bg-orange-50 font-bold py-3.5 rounded-xl transition-colors">
                        <i class="fa-regular fa-map mr-2"></i> Navigasi ke Restoran
                    </a>
                </div>
            @endif
        </div>

    </div>

</x-app-layout>
