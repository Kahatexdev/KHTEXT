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
        Schema::create('tb_pdk', function (Blueprint $table) {
            $table->id('id_pdk');
            $table->string('no_model', 25);
            $table->string('area', 25);
            $table->string('jc', 100);
            $table->string('inisial', 25);
            $table->string('keterangan');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pdk');
    }
};
