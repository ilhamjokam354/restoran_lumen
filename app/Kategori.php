<?php

namespace App;



use Illuminate\Database\Eloquent\Model;



class Kategori extends Model 
{
    

    
    protected $fillable = [
        'id_kategori', 'kategori'
    ];
    
    protected $primaryKey = 'id_kategori';
}
