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
        Schema::create('inproduct_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inproduct_id');
            $table->foreign('inproduct_id')->references('id')->on('inproducts');
            $table->string('kode_produk');
            $table->string('nama');
            $table->string('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inproduct_details');
    }
};
