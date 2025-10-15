<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    /** @use HasFactory<\Database\Factories\CatatanFactory> */
    use HasFactory;

    protected $illable = [ 
        'judul',
        'isi',
        'kategori',
        'user',
    ];

    protected $guarded = [];

}
