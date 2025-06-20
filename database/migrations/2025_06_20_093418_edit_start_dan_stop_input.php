<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('input_erp', function (Blueprint $table) {
            // Ubah tipe kolom menjadi time
            $table->time('start_input')->change();
            $table->time('stop_input')->change();
        });
    }

    public function down(): void
    {
        Schema::table('input_erp', function (Blueprint $table) {
            // Kembalikan ke tipe semula (date)
            $table->date('start_input')->change();
            $table->date('stop_input')->change();
        });
    }
};
