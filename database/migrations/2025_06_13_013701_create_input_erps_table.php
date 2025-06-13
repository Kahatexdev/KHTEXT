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
        Schema::create('input_erp', function (Blueprint $table) {
            $table->id('id_input');
            $table->date('tanggal_input');
            $table->date('start_input');
            $table->date('stop_input');
            $table->string('area', 20);
            $table->integer('ttl_mc');
            $table->integer('jln_mc');
            $table->double('prod_erp');
            $table->string('ket');
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
        Schema::dropIfExists('input_erp');
    }
};
