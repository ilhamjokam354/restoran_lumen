<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VorderController extends Controller
{
    //
    public function vorder(){
        $result = DB::select('SELECT * FROM vorder ORDER BY status , id_order ASC');

        return $result;
    }

    public function show($id){
        $result = DB::select('SELECT * FROM vorder WHERE id_order = :id', ['id' => $id]);
        return $result;
    }
    public function search($keyword){
        // $keyword = $request->input('keyword');
        $result = DB::select('SELECT * FROM vorder WHERE user LIKE "%'.$keyword.'%" OR telepon LIKE "%'.$keyword.'%" OR status LIKE "%'.$keyword.'%" OR alamat LIKE "%'.$keyword.'%"', ['keyword' => $keyword]);
        return $result;
    }

    public function searchOrderDetail($keyword){
        // $keyword = $request->input('keyword');
        $result = DB::select('SELECT * FROM vorderdetail WHERE user LIKE "%'.$keyword.'%" OR menu LIKE "%'.$keyword.'%" OR total LIKE "%'.$keyword.'%" OR alamat LIKE "%'.$keyword.'%"', ['keyword' => $keyword]);
        return $result;
    }

    public function vorderdetail(){
        $result = DB::select('SELECT * FROM vorderdetail ORDER BY id_order_detail DESC');
        return $result;
    }

    public function searchTglOrder($tgl_awal, $tgl_akhir){
        $result = DB::select('SELECT * FROM vorderdetail WHERE tgl_order BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'" ', ['tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir]);
        return $result;

    }
}
