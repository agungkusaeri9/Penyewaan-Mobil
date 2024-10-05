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
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('kode')->unique();
            $table->foreignId('peminjaman_id')->constrained('peminjaman');
            $table->dateTime('tanggal_pengembalian');
            $table->string('kondisi_mobil');
            $table->bigInteger('total_denda')->default(0);
            $table->text('catatan')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
