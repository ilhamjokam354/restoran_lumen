<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $fillable = [
        'id_user', 'user', 'email', 'password', 'level', 'aktif'
    ];

    protected $primaryKey = 'id_user';
}
