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
        Schema::create('kronologi', function (Blueprint $table) {
            $table->id('id_kronologi');
            $table->foreignId('id_kategori')->references('id_kategori')->on('kategori_kronologi')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('pdk_fail', 10);
            $table->string('style_fail', 50);
            $table->string('inisial_fail', 10);
            $table->string('area_fail', 20);
            $table->string('label_fail', 50);
            $table->integer('no_mc_fail');
            $table->string('no_box_fail', 50);
            $table->double('qty_fail', 11, 2);
            $table->string('pdk_true', 10);
            $table->string('style_true', 50);
            $table->string('inisial_true', 10);
            $table->string('area_true', 20);
            $table->string('label_true', 50);
            $table->integer('no_mc_true');
            $table->string('no_box_true', 50);
            $table->double('qty_true', 11, 2);
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kronologi');
    }
};
