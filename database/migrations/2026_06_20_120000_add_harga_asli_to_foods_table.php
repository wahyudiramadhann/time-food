<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('foods', function (Blueprint $table) {
            if (!Schema::hasColumn('foods', 'harga_asli')) {
                $table->decimal('harga_asli', 12, 2)->nullable()->after('harga');
            }
        });
    }

    public function down(): void
    {
        Schema::table('foods', function (Blueprint $table) {
            if (Schema::hasColumn('foods', 'harga_asli')) {
                $table->dropColumn('harga_asli');
            }
        });
    }
};
