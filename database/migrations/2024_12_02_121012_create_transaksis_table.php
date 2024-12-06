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
            $table->unsignedBigInteger('barang_id');
            $table->string('barang_nama');
            $table->string('kategori_barang');
            $table->integer('harga_barang');
            $table->integer('stok_barang');
            $table->string('ukuran_barang');
            $table->integer('jumlah_barang');
            $table->integer('total_harga_barang');
            $table->unsignedBigInteger('user_id');
            $table->string('usernama');
            $table->unsignedBigInteger('supplier_id');
            $table->string('supplier_nama');
            $table->string('bulan');
            $table->string('tanggal');
            $table->string('tanggalAkhir');
            $table->integer('status');
            $table->integer('statusAkhir');
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