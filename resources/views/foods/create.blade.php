<x-app-layout>

    <div class="max-w-4xl py-10 mx-auto">

        <h1 class="mb-6 text-3xl font-bold">
            Tambah Makanan
        </h1>

        <form action="{{ route('foods.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <input type="text" name="nama" placeholder="Nama Makanan" class="w-full p-3 mb-3 border">

            <textarea name="deskripsi" placeholder="Deskripsi" class="w-full p-3 mb-3 border"></textarea>

            <input type="file" name="foto" class="w-full p-3 mb-3 border">

            <input type="number" name="stok" placeholder="Stok" class="w-full p-3 mb-3 border">

            <input type="number" name="harga" placeholder="Harga" class="w-full p-3 mb-3 border">

            <select name="jenis" class="w-full p-3 mb-3 border">

                <option value="real_food">
                    Real Food
                </option>

                <option value="gacha">
                    Gacha Food
                </option>

            </select>

            <input type="text" name="alamat" placeholder="Alamat" class="w-full p-3 mb-3 border">

            <input type="time" name="pickup_time" class="w-full p-3 mb-3 border">

            <button class="px-6 py-3 text-white bg-green-600 rounded">

                Simpan

            </button>

        </form>

    </div>

</x-app-layout>
