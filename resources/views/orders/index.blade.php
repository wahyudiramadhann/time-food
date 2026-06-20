<x-app-layout>

    <div class="max-w-5xl py-6 mx-auto">

        <h2 class="mb-6 text-2xl font-bold">
            Pesanan Saya
        </h2>

        @forelse($orders as $order)
            <div style="border:1px solid #ddd;padding:15px;margin-bottom:15px;border-radius:8px;">

                <h3>
                    {{ $order->food->nama }}
                </h3>

                <p>
                    Jumlah: {{ $order->qty }}
                </p>

                <p>
                    Total: Rp {{ number_format($order->total) }}
                </p>

                <p>
                    Pickup Code:
                    <strong>{{ $order->pickup_code }}</strong>
                </p>

                <p>
                    Status:
                    {{ ucfirst($order->status) }}
                </p>

            </div>

        @empty

            <p>Belum ada pesanan.</p>
        @endforelse

    </div>

</x-app-layout>
