<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'barang_nama',
        'kategori_barang',
        'harga_barang',
        'stok_barang',
        'ukuran_barang',
        'jumlah_barang',
        'user_id',
        'supplier_id',
    ];
}
