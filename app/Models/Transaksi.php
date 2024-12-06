<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'barang_id',
        'barang_nama',
        'kategori_barang',
        'harga_barang',
        'stok_barang',
        'ukuran_barang',
        'jumlah_barang',
        'total_harga_barang',
        'user_id',
        'usernama',
        'supplier_id',
        'supplier_nama',
        'bulan',
        'tanggal',
        'tanggalAkhir',
        'status',
        'statusAkhir'
    ];
}
