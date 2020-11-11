<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $fillable = [
        'id_menu', 'id_kategori', 'menu', 'gambar', 'harga'
    ];

    protected $primaryKey = 'id_menu';
}
