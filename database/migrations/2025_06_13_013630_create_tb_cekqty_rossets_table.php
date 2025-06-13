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
        Schema::create('tb_cekqty_rosset', function (Blueprint $table) {
            $table->id('id_cekqty_rosset');
            $table->date('tanggal_input');
            $table->integer('ttl_mc');
            $table->integer('jl_mc');
            $table->string('area', 20);
            $table->string('bagian', 20);
            $table->double('qty_erp_rosset', 11, 2);
            $table->double('qty_mis_rosset', 11, 2);
            $table->double('qty_reject', 11, 2);
            $table->double('qty_rework', 11, 2);
            $table->integer('direct');
            $table->string('ket_erp_rosset');
            $table->string('ket_mis_rosset');
            $table->string('ket_overshift_siang_kepagi');
            $table->string('ket_overshift_pagi_kesiang');
            $table->string('ket_reject');
            $table->string('ket_rework');
            $table->string('shift');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_cekqty_rosset');
    }
};
