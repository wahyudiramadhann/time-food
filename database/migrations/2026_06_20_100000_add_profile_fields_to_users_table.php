<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Cek tiap kolom sebelum tambah (kompatibel dengan branch teman)
            if (!Schema::hasColumn('users', 'foto')) {
                $table->string('foto')->nullable()->after('password');
            }
            if (!Schema::hasColumn('users', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('foto');
            }
            if (!Schema::hasColumn('users', 'no_hp')) {
                $table->string('no_hp', 20)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $cols = [];
            if (Schema::hasColumn('users', 'foto'))     $cols[] = 'foto';
            if (Schema::hasColumn('users', 'deskripsi')) $cols[] = 'deskripsi';
            if (Schema::hasColumn('users', 'no_hp'))    $cols[] = 'no_hp';
            if (!empty($cols)) $table->dropColumn($cols);
        });
    }
};
