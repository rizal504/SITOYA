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
        Schema::create('total_bulanans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('alamat');
            $table->string('keterangan');
            $table->date('tanggal');
            $table->bigInteger('total_masuk');
            $table->bigInteger('total_kurang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('total_bulanans');
    }
};
