<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Restoran Dummy
        $resto = User::firstOrCreate(
            ['email' => 'solaria@timefood.com'],
            [
                'name' => 'Solaria',
                'password' => Hash::make('password123'),
                'role' => 'restaurant',
                'deskripsi' => 'Menyediakan berbagai masakan Nusantara dengan rasa autentik yang lezat.',
                'alamat' => 'Mall Kelapa Gading 3, Lantai 2',
                'no_hp' => '081234567890'
            ]
        );

        // 2. Buat Akun Customer Dummy
        $customer = User::firstOrCreate(
            ['email' => 'customer@timefood.com'],
            [
                'name' => 'Budi Setiawan',
                'password' => Hash::make('password123'),
                'role' => 'user'
            ]
        );

        // 3. Data Makanan (Gacha & Real Food)
        $foodsData = [
            [
                'nama' => 'Nasi Goreng Spesial (Surplus)',
                'deskripsi' => 'Nasi goreng ayam dengan telur mata sapi. Porsi malam sebelum tutup.',
                'harga' => 15000,
                'harga_asli' => 35000,
                'stok' => 5,
                'jenis' => 'real_food',
                'pickup_time_start' => '20:00:00',
                'pickup_time_end' => '22:00:00',
            ],
            [
                'nama' => 'Misteri Box Nasi (Gacha)',
                'deskripsi' => 'Isinya bisa Nasi Gila, Nasi Capcay, atau Kwetiau. Siap-siap terkejut!',
                'harga' => 12000,
                'harga_asli' => 30000,
                'stok' => 10,
                'jenis' => 'gacha',
                'pickup_time_start' => '21:00:00',
                'pickup_time_end' => '22:30:00',
            ],
            [
                'nama' => 'Chicken Cordon Bleu (Sisa Etalase)',
                'deskripsi' => 'Ayam gulung keju yang masih hangat. Dibuat siang hari, masih sangat layak makan.',
                'harga' => 25000,
                'harga_asli' => 55000,
                'stok' => 2,
                'jenis' => 'real_food',
                'pickup_time_start' => '19:00:00',
                'pickup_time_end' => '21:00:00',
            ],
            [
                'nama' => 'Sweet Treat Gacha',
                'deskripsi' => 'Puding, Es Campur, atau Es Teler? Cocok buat cuci mulut.',
                'harga' => 8000,
                'harga_asli' => 18000,
                'stok' => 8,
                'jenis' => 'gacha',
                'pickup_time_start' => '15:00:00',
                'pickup_time_end' => '18:00:00',
            ]
        ];

        $foodModels = [];
        foreach ($foodsData as $data) {
            $foodModels[] = Food::firstOrCreate(
                ['nama' => $data['nama']], // Cegah duplikat
                array_merge($data, [
                    'user_id' => $resto->id,
                    'status' => 'aktif'
                ])
            );
        }

        // 4. Generate Riwayat Transaksi (Untuk grafik di dashboard)
        // Kita bikin 15 transaksi dalam seminggu terakhir
        if (Order::count() < 5) {
            for ($i = 0; $i < 15; $i++) {
                $food = $foodModels[array_rand($foodModels)];
                $qty = rand(1, 3);
                $statusList = ['completed', 'completed', 'completed', 'cancelled', 'paid', 'ready'];
                $status = $statusList[array_rand($statusList)];
                
                // Random date within last 7 days
                $date = now()->subDays(rand(0, 7))->subHours(rand(1, 24));

                Order::create([
                    'user_id' => $customer->id,
                    'food_id' => $food->id,
                    'qty' => $qty,
                    'total' => $food->harga * $qty,
                    'pickup_code' => 'TF-' . strtoupper(Str::random(6)),
                    'status' => $status,
                    'created_at' => $date,
                    'updated_at' => $date->addMinutes(30)
                ]);
            }
        }
    }
}
