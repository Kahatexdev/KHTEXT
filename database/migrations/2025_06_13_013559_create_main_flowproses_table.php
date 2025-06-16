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
        Schema::create('main_flowproses', function (Blueprint $table) {
            $table->id('id_main_flow');
            // $table->foreignId('id_pdk')->references('id_pdk')->on('tb_pdk')->onDelete('cascade');
            $table->string('idapsperstyle', 25); // from capacity
            $table->date('tanggal');
            $table->string('ket')->nullable();
            $table->string('area', 50)->nullable();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_flowproses');
    }
};
