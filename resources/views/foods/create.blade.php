@extends('layouts.restaurant')
@section('content')
<div class="max-w-xl mx-auto space-y-5">
    <div class="flex items-center gap-3">
        <a href="{{ route('foods.index') }}"
            class="w-9 h-9 rounded-lg bg-white shadow-sm flex items-center justify-center text-slate-400 hover:text-slate-600 transition-colors">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-xl font-bold text-slate-800">Tambah Makanan</h1>
            <p class="text-slate-400 text-xs">Tambahkan produk baru ke menu restoran</p>
        </div>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl p-4">
            <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('foods.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        {{-- Upload Foto --}}
        <div class="bg-white rounded-xl shadow-sm p-5">
            <label class="block text-sm font-semibold text-slate-700 mb-3">Foto Makanan</label>
            <div id="dropzone"
                class="border-2 border-dashed border-slate-200 rounded-xl p-8 text-center cursor-pointer hover:border-orange-400 transition-colors"
                onclick="document.getElementById('fotoInput').click()">
                <img id="preview" src="" alt="" class="hidden mx-auto max-h-40 rounded-lg object-cover mb-3">
                <div id="placeholder">
                    <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fa-solid fa-cloud-arrow-up text-orange-400 text-xl"></i>
                    </div>
                    <p class="text-sm font-medium text-slate-600">Klik untuk upload foto</p>
                    <p class="text-xs text-slate-400 mt-1">PNG, JPG, WEBP · Max 2MB</p>
                </div>
                <input type="file" id="fotoInput" name="foto" accept="image/*" class="hidden"
                    onchange="previewImage(event)">
            </div>
        </div>

        {{-- Info Produk --}}
        <div class="bg-white rounded-xl shadow-sm p-5 space-y-4">
            <h3 class="text-sm font-semibold text-slate-700">Informasi Produk</h3>
            <div>
                <label class="block text-xs font-medium text-slate-500 mb-1.5">Nama Produk</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required
                    class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 bg-slate-50"
                    placeholder="Contoh: Nasi Padang Komplit">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-500 mb-1.5">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                    class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 bg-slate-50 resize-none"
                    placeholder="Ceritakan sedikit tentang makanan ini...">{{ old('deskripsi') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Jumlah Stok</label>
                    <input type="number" name="stok" value="{{ old('stok', 1) }}" min="0" required
                        class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 bg-slate-50">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1.5">Dari Jam</label>
                        <input type="time" name="pickup_time_start" value="{{ old('pickup_time_start') }}" required
                            class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1.5">Sampai Jam</label>
                        <input type="time" name="pickup_time_end" value="{{ old('pickup_time_end') }}" required
                            class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 bg-slate-50">
                    </div>
                </div>
            </div>
        </div>

        {{-- Harga --}}
        <div class="bg-white rounded-xl shadow-sm p-5 space-y-4">
            <h3 class="text-sm font-semibold text-slate-700">Harga</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Harga Asli</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm font-medium">Rp</span>
                        <input type="number" name="harga_asli" value="{{ old('harga_asli') }}"
                            class="w-full border border-slate-200 rounded-lg pl-9 pr-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 bg-slate-50"
                            placeholder="0">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Harga Jual</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm font-medium">Rp</span>
                        <input type="number" name="harga" value="{{ old('harga') }}" required
                            class="w-full border border-slate-200 rounded-lg pl-9 pr-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 bg-slate-50"
                            placeholder="0">
                    </div>
                </div>
            </div>
        </div>

        {{-- Kategori --}}
        <div class="bg-white rounded-xl shadow-sm p-5">
            <h3 class="text-sm font-semibold text-slate-700 mb-3">Kategori</h3>

            {{-- Hidden actual input --}}
            <input type="hidden" name="jenis" id="jenis_input" value="{{ old('jenis', 'real_food') }}">

            <div class="grid grid-cols-2 gap-3">
                <button type="button" onclick="selectJenis('gacha')" id="btn_gacha"
                    class="jenis-btn border-2 rounded-xl p-4 text-center transition-all duration-150 border-slate-200 bg-white hover:border-orange-300">
                    <i class="fa-solid fa-dice text-2xl text-slate-400 mb-2 block" id="icon_gacha"></i>
                    <p class="text-sm font-semibold text-slate-700">Gacha</p>
                    <p class="text-xs text-slate-400">Paket kejutan</p>
                </button>
                <button type="button" onclick="selectJenis('real_food')" id="btn_real_food"
                    class="jenis-btn border-2 rounded-xl p-4 text-center transition-all duration-150 border-orange-500 bg-orange-50 hover:border-orange-300">
                    <i class="fa-solid fa-bowl-food text-2xl text-orange-500 mb-2 block" id="icon_real_food"></i>
                    <p class="text-sm font-semibold text-slate-700">Real Food</p>
                    <p class="text-xs text-slate-400">Makanan biasa</p>
                </button>
            </div>
        </div>

        <button type="submit"
            class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3.5 rounded-xl transition-colors text-sm">
            <i class="fa-solid fa-plus mr-2"></i>Unggah Produk
        </button>
    </form>
</div>

<script>
function previewImage(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (ev) => {
        document.getElementById('preview').src = ev.target.result;
        document.getElementById('preview').classList.remove('hidden');
        document.getElementById('placeholder').classList.add('hidden');
    };
    reader.readAsDataURL(file);
}

function selectJenis(val) {
    document.getElementById('jenis_input').value = val;

    const btns = ['gacha', 'real_food'];
    btns.forEach(b => {
        const btn = document.getElementById('btn_' + b);
        const icon = document.getElementById('icon_' + b);
        if (b === val) {
            btn.classList.remove('border-slate-200', 'bg-white');
            btn.classList.add('border-orange-500', 'bg-orange-50');
            icon.classList.remove('text-slate-400');
            icon.classList.add('text-orange-500');
        } else {
            btn.classList.remove('border-orange-500', 'bg-orange-50');
            btn.classList.add('border-slate-200', 'bg-white');
            icon.classList.remove('text-orange-500');
            icon.classList.add('text-slate-400');
        }
    });
}

// Set initial state from old() value
document.addEventListener('DOMContentLoaded', () => {
    selectJenis(document.getElementById('jenis_input').value || 'real_food');
});
</script>
@endsection
