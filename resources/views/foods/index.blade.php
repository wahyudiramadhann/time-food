@extends('layouts.restaurant')
@section('content')

    <div class="max-w-6xl py-6 mx-auto">

        <h2 class="mb-4 text-2xl font-bold">
            Daftar Makanan
        </h2>

        <a href="{{ route('foods.create') }}">
            Tambah Makanan
        </a>

        <hr>

        @forelse($foods as $food)
            <div style="margin-top:20px">

                <h3>{{ $food->nama }}</h3>

                <p>
                    Rp {{ number_format($food->harga) }}
                </p>

                <p>
                    Stok: {{ $food->stok }}
                </p>

            </div>

        @empty

            <p>Belum ada makanan.</p>
        @endforelse

    </div>

@endsection
