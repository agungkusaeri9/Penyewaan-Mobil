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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('kode')->unique();
            $table->foreignId('mobil_id')->constrained('mobil');
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_akhir');
            $table->integer('durasi');
            $table->bigInteger('harga');
            $table->bigInteger('total_bayar');
            $table->foreignId('metode_pembayaran_id')->constrained('metode_pembayaran');
            $table->foreignId('user_id')->constrained('users');
            $table->string('bukti_pembayaran')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
