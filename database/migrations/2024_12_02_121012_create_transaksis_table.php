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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('barang_id')->nullable();
            $table->string('barang_nama')->nullable();
            $table->string('kategori_barang')->nullable();
            $table->integer('harga_barang')->nullable();
            $table->integer('stok_barang')->nullable();
            $table->string('ukuran_barang')->nullable();
            $table->integer('jumlah_barang')->nullable();
            $table->integer('total_harga_barang')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('usernama')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('supplier_nama')->nullable();
            $table->string('bulan')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('tanggalAkhir')->nullable();
            $table->integer('status')->nullable();
            $table->integer('statusAkhir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};