<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $fillable = [
        'id_order_detail', 'id_order', 'id_menu', 'jumlah', 'harga_jual'
    ];

    protected $primaryKey = 'id_order_detail';
}
