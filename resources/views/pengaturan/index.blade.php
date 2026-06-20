@extends('layouts.restaurant')

@section('content')
<div class="max-w-2xl mx-auto space-y-5">

    <div>
        <h1 class="text-xl font-bold text-slate-800">Pengaturan Restoran</h1>
        <p class="text-slate-400 text-xs mt-0.5">Kelola profil dan informasi restoran kamu</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pengaturan.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Foto Profil --}}
        <div class="bg-white rounded-xl shadow-sm p-5">
            <h3 class="text-sm font-semibold text-slate-700 mb-4">Foto Profil Restoran</h3>
            <div class="flex items-start gap-5">
                {{-- Preview --}}
                <div class="flex-shrink-0">
                    <div class="w-24 h-24 rounded-2xl overflow-hidden border-2 border-slate-200 bg-slate-50 flex items-center justify-center cursor-pointer hover:border-orange-400 transition-colors"
                        onclick="document.getElementById('fotoInput').click()">
                        @if($user->foto)
                            <img id="fotoPreview" src="{{ asset('storage/' . $user->foto) }}"
                                class="w-full h-full object-cover" alt="Foto Restoran">
                        @else
                            <img id="fotoPreview" src="" alt="" class="w-full h-full object-cover hidden">
                            <div id="fotoPlaceholder" class="text-center">
                                <span class="text-3xl font-black text-orange-500">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                {{-- Upload Button --}}
                <div class="flex-1">
                    <p class="text-sm font-medium text-slate-700 mb-1">{{ $user->name }}</p>
                    <p class="text-xs text-slate-400 mb-3">{{ $user->email }}</p>
                    <button type="button" onclick="document.getElementById('fotoInput').click()"
                        class="inline-flex items-center gap-2 bg-slate-100 hover:bg-orange-100 text-slate-600 hover:text-orange-600 text-xs font-semibold px-4 py-2 rounded-lg transition-colors">
                        <i class="fa-solid fa-camera text-xs"></i>
                        {{ $user->foto ? 'Ganti Foto' : 'Upload Foto' }}
                    </button>
                    <p class="text-xs text-slate-400 mt-2">PNG, JPG · Max 2MB. Akan digunakan sebagai logo/avatar restoran.</p>
                    <input type="file" id="fotoInput" name="foto" accept="image/*" class="hidden"
                        onchange="previewFoto(event)">
                </div>
            </div>
        </div>

        {{-- Informasi Dasar --}}
        <div class="bg-white rounded-xl shadow-sm p-5 space-y-4">
            <h3 class="text-sm font-semibold text-slate-700">Informasi Dasar</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Nama Restoran <span class="text-red-400">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 bg-slate-50">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Email <span class="text-red-400">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 bg-slate-50">
                </div>
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-500 mb-1.5">Deskripsi / Tagline Restoran</label>
                <textarea name="deskripsi" rows="3" maxlength="500"
                    class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 bg-slate-50 resize-none"
                    placeholder="Contoh: Restoran keluarga dengan masakan autentik Minang sejak 1995...">{{ old('deskripsi', $user->deskripsi) }}</textarea>
                <p class="text-xs text-slate-400 mt-1">Max 500 karakter</p>
            </div>
        </div>

        {{-- Kontak & Lokasi --}}
        <div class="bg-white rounded-xl shadow-sm p-5 space-y-4">
            <h3 class="text-sm font-semibold text-slate-700">Kontak & Lokasi</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Nomor HP / WhatsApp</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">
                            <i class="fa-solid fa-phone text-xs"></i>
                        </span>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                            class="w-full border border-slate-200 rounded-lg pl-8 pr-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 bg-slate-50"
                            placeholder="08xxxxxxxxxx">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Alamat Restoran</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">
                            <i class="fa-solid fa-location-dot text-xs"></i>
                        </span>
                        <input type="text" name="alamat" value="{{ old('alamat', $user->alamat) }}"
                            class="w-full border border-slate-200 rounded-lg pl-8 pr-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 bg-slate-50"
                            placeholder="Jl. Contoh No. 123, Kota">
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex items-center justify-between gap-3">
            <a href="{{ route('profile.edit') }}"
                class="text-xs text-slate-400 hover:text-slate-600 transition-colors">
                <i class="fa-solid fa-lock mr-1"></i> Ubah Password
            </a>
            <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-xl transition-colors text-sm">
                <i class="fa-solid fa-floppy-disk mr-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
function previewFoto(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (ev) => {
        const preview = document.getElementById('fotoPreview');
        const placeholder = document.getElementById('fotoPlaceholder');
        preview.src = ev.target.result;
        preview.classList.remove('hidden');
        if (placeholder) placeholder.classList.add('hidden');
    };
    reader.readAsDataURL(file);
}
</script>
@endsection
