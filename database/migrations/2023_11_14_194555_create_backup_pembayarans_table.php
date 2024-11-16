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
        Schema::create('backup_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('warga_id');
            $table->foreign('warga_id')->references('id')->on('data_wargas');
            $table->unsignedBigInteger('riwayatpembayaran_id');
            $table->foreign('riwayatpembayaran_id')->references('id')->on('riwayat_pembayarans');
            $table->bigInteger('totalbayar');
            $table->bigInteger('bayar');
            $table->bigInteger('untuk_ditotal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backup_pembayarans');
    }
};
