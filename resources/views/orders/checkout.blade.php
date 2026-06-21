<x-app-layout>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Back Button -->
        <a href="{{ route('menu.index') }}" class="inline-flex items-center text-sm font-bold text-gray-800 hover:text-orange-500 mb-6 transition-colors">
            <i class="fa-solid fa-chevron-left mr-2"></i> Checkout
        </a>

        <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Pesanan Anda</h2>
            
            <div class="flex items-center justify-between border-b border-gray-100 pb-6 mb-6">
                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                        @if($order->food->foto)
                            <img src="{{ $order->food->foto_url }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">{{ $order->food->nama }}</h3>
                        <p class="text-sm text-gray-500 mb-1"><i class="fa-solid fa-store text-orange-400 mr-1"></i> Restoran Anda</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-bold text-gray-800 mb-1">Rp{{ number_format($order->food->harga, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500">x{{ $order->qty }}</p>
                </div>
            </div>

            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-600 font-medium">Subtotal</span>
                <span class="text-gray-800 font-bold">Rp{{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-center pb-6 border-b border-gray-100">
                <span class="text-gray-600 font-medium">Biaya Layanan</span>
                <span class="text-green-500 font-bold">Gratis</span>
            </div>

            <div class="flex justify-between items-center pt-6">
                <span class="text-lg font-bold text-gray-800">Total Pesanan</span>
                <span class="text-2xl font-black text-orange-500">Rp{{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <form action="{{ route('orders.pay', $order->id) }}" method="POST">
            @csrf
            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Metode Pembayaran</h2>
                
                <div class="space-y-3">
                    <label class="flex items-center justify-between p-4 border border-orange-500 rounded-xl bg-orange-50 cursor-pointer transition-colors">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="payment" value="qris" class="w-5 h-5 text-orange-500 focus:ring-orange-500" checked>
                            <span class="font-bold text-gray-800">QRIS</span>
                        </div>
                        <i class="fa-solid fa-qrcode text-orange-500 text-xl"></i>
                    </label>
                    <label class="flex items-center justify-between p-4 border border-gray-200 rounded-xl hover:bg-gray-50 cursor-pointer transition-colors">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="payment" value="ewallet" class="w-5 h-5 text-orange-500 focus:ring-orange-500">
                            <span class="font-bold text-gray-800">E-Wallet</span>
                        </div>
                        <div class="flex gap-2">
                            <i class="fa-solid fa-wallet text-gray-400 text-xl"></i>
                        </div>
                    </label>
                    <label class="flex items-center justify-between p-4 border border-gray-200 rounded-xl hover:bg-gray-50 cursor-pointer transition-colors">
                        <div class="flex items-center gap-3">
                            <input type="radio" name="payment" value="transfer" class="w-5 h-5 text-orange-500 focus:ring-orange-500">
                            <span class="font-bold text-gray-800">Transfer Bank</span>
                        </div>
                        <i class="fa-solid fa-building-columns text-gray-400 text-xl"></i>
                    </label>
                </div>
            </div>

            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-orange-500/30 transition-colors mb-4">
                Bayar Sekarang
            </button>
            <p class="text-center text-xs text-gray-500">
                Dengan melanjutkan pembayaran, Anda menyetujui <a href="#" class="text-orange-500 hover:underline">Syarat & Ketentuan TimeFood</a>.
            </p>
        </form>

    </div>

</x-app-layout>
