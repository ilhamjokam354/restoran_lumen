<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //
    public function key(){
        return Str::random(32);
    }
}

//php artisan make:migrations create_users_table --create=users contoh membuat migrations