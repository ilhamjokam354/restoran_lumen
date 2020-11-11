<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVorderViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("
            CREATE VIEW vorderr AS 
            (
            SELECT orders.id_order, orders.id_user, orders.tgl_order, orders.total, orders.bayar, orders.kembali, orders.status, users.user, users.alamat, users.telepon, users.email, users.password, users.aktif
            FROM users INNER JOIN orders ON users.id_user = orders.id_user;
         )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vorder');
    }
}
