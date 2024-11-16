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
        Schema::create('riwayat_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique(); // Tambahkan kolom untuk UUID
            $table->string('generated_token')->nullable()->unique();
            $table->timestamps();
            $table->unsignedBigInteger('warga_id');
            $table->foreign('warga_id')->references('id')->on('data_wargas');
            $table->bigInteger('kondisimeteran')->nullable();
            $table->bigInteger('totalpemakaian')->nullable();
            $table->bigInteger('totalbayar')->nullable();
            $table->bigInteger('bayar')->nullable();
            $table->bigInteger('kurang')->nullable();
            $table->integer('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pembayarans');
    }
};
