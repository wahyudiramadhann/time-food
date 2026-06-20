<x-app-layout>

    <div class="max-w-6xl py-6 mx-auto">

        <h2 class="mb-4 text-2xl font-bold">
            Daftar Makanan
        </h2>

        <a href="{{ route('foods.create') }}"
            style="background:green;color:white;padding:10px;text-decoration:none;border-radius:5px;">
            Tambah Makanan
        </a>

        <br><br>

        @forelse($foods as $food)
            <div
                style="
                border:1px solid #ddd;
                padding:15px;
                margin-bottom:20px;
                border-radius:10px;
            ">

                @if ($food->foto)
                    <img src="{{ asset('storage/' . $food->foto) }}" width="250" style="border-radius:10px">
                @else
                    <p>Foto tidak tersedia</p>
                @endif

                <h3 style="margin-top:10px">
                    {{ $food->nama }}
                </h3>

                <p>
                    <strong>Harga:</strong>
                    Rp {{ number_format($food->harga) }}
                </p>

                <p>
                    <strong>Stok:</strong>
                    {{ $food->stok }}
                </p>

                <p>
                    <strong>Alamat:</strong>
                    {{ $food->alamat }}
                </p>

                <p>
                    <strong>Pickup:</strong>
                    {{ $food->pickup_time }}
                </p>

                <a href="{{ route('foods.show', $food->id) }}"
                    style="
                        background:#2563eb;
                        color:white;
                        padding:8px 15px;
                        text-decoration:none;
                        border-radius:5px;
                    ">
                    Lihat Detail
                </a>

            </div>

        @empty

            <p>Belum ada makanan.</p>
        @endforelse

    </div>

</x-app-layout>
