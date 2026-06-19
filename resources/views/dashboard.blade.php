@if(auth()->user()->role === 'restaurant')
    @extends('layouts.restaurant')
    
    @section('content')
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Makanan Saya</h3>

            <a href="{{ route('foods.create') }}" class="text-blue-600 underline">
                + Tambah Makanan
            </a>

            <div class="mt-4">
                @forelse($foods as $food)
                    <div class="border-b py-2">
                        {{ $food->nama }} — Rp{{ number_format($food->harga) }} — Stok: {{ $food->stok }}
                    </div>
                @empty
                    <p>Belum ada makanan yang kamu tambahkan.</p>
                @endforelse
            </div>
        </div>
    @endsection
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{-- DASHBOARD USER --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Makanan Tersedia</h3>

                    <div class="mt-4">
                        @forelse($foods as $food)
                            <div class="border-b py-2">
                                {{ $food->nama }} — Rp{{ number_format($food->harga) }}
                            </div>
                        @empty
                            <p>Belum ada makanan tersedia saat ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif