<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_cekqty', function (Blueprint $table) {
            $table->id('id_cekqty');
            $table->date('tanggal_input');
            $table->string('area', 20);
            $table->double('qty_erp', 11, 2);
            $table->double('qty_timter', 11, 2);
            $table->double('qty_summary', 11, 2);
            $table->double('qty_running', 11, 2);
            $table->double('qty_apk', 11, 2);
            $table->double('qty_reject', 11, 2);
            $table->double('qty_rework', 11, 2);
            $table->string('ket_reject');
            $table->string('ket_rework');
            $table->string('ket_erp');
            $table->string('ket_timter');
            $table->string('ket_summary');
            $table->string('ket_running');
            $table->string('ket_apk');
            $table->string('shift', 20);
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_cekqty');
    }
};
