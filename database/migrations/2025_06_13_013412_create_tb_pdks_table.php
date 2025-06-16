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
            $table->string('mastermodel', 25); // no_model
            $table->string('factory', 25);     // area
            $table->string('size', 100);       // jc
            $table->string('inisial', 25);
            $table->text('keterangan')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
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
