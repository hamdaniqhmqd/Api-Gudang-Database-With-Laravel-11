<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_supplier';

    protected $fillable = [
        'nama_supplier',
        'nik_supplier',
        'no_hp_supplier',
        'insert',
        'update'
    ];
}
