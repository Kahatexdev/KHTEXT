<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kronologi_kesalahan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->string('wip')->nullable();
            $table->string('area')->nullable();
            // Data Barang Salah
            $table->string('no_model_salah')->nullable();
            $table->string('style_salah')->nullable();
            $table->string('label_salah')->nullable();
            $table->string('no_mc_salah')->nullable();
            $table->string('krj_salah')->nullable();
            $table->integer('qty_salah')->nullable();
            // Data Barang Benar
            $table->string('no_model_benar')->nullable();
            $table->string('style_benar')->nullable();
            $table->string('label_benar')->nullable();
            $table->string('no_mc_benar')->nullable();
            $table->string('krj_benar')->nullable();
            $table->integer('qty_benar')->nullable();
            // Lain-lain
            $table->string('kategori')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('keterangan_maintenance')->nullable();
            $table->string('username')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kronologi_kesalahan');
    }
};
