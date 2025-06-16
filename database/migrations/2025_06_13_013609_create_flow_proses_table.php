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
        Schema::create('flow_proses', function (Blueprint $table) {
            $table->id('id_flow_proses');
            $table->foreignId('id_main_flow')->references('id_main_flow')->on('main_flowproses')->onDelete('cascade');
            $table->foreignId('id_master_proses')->references('id_master_proses')->on('master_proses')->onDelete('cascade');
            $table->integer('step_order')->default(1); // urutan proses 1..6
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flow_proses');
    }
};
