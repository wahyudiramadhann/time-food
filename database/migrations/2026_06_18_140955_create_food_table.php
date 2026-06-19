<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();

            $table->integer('stok')->default(0);
            $table->decimal('harga', 12, 2);

            $table->enum('jenis', [
                'gacha',
                'real_food'
            ])->default('real_food');

            $table->string('alamat')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->time('pickup_time')->nullable();

            $table->enum('status', [
                'aktif',
                'habis'
            ])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};