<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->dropColumn('pickup_time');
            $table->time('pickup_time_start')->nullable()->after('longitude');
            $table->time('pickup_time_end')->nullable()->after('pickup_time_start');
        });
    }

    public function down(): void
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->dropColumn(['pickup_time_start', 'pickup_time_end']);
            $table->time('pickup_time')->nullable()->after('longitude');
        });
    }
};
