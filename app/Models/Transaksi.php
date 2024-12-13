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
        'jumlah_barang',
        'total_harga_barang',
        'user_id',
        'supplier_id',
        'bulan',
        'tanggal',
        'tanggalAkhir',
        'status',
        'statusAkhir'
    ];
}
