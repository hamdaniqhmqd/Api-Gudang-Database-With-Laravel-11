<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'adminName',
        'profileImagePath',
    ];

    // protected $hidden = [
    //     'password',
    // ];
}