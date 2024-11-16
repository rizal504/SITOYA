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
        Schema::create('keuangan_bulanans', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique(); // Tambahkan kolom untuk UUID
            $table->string('generated_token')->nullable()->unique();
            $table->date('tanggal');
            $table->string('kategori');
            $table->string('keterangan');
            $table->bigInteger('pemasukan')->nullable();
            $table->bigInteger('pengeluaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan_bulanans');
    }
};
