<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderDetail;

class OrderDetailController extends Controller
{
    public function __construct(\App\OrderDetail $order_detail){
        $this->order_detail = $order_detail;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = $this->order_detail->paginate(20);
        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $post = $this->order_detail->create($input);
        if($post){
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Tambah Data Berhasil',
                    'data' => $post
                ], 200
            );
        }else{
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Tambah Data Gagal',
                    'data' => ''
                ], 404
            );
        }
    }
        

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $post = OrderDetail::where('id_order_detail', $id)->first();
        if($post){
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Ditemukan',
                'data' => $post
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ditemukan',
                'data' => ''
            ], 404);
        }

        // return response()->json(Menu::find($id));

         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $id = OrderDetail::where('id_order_detail', $id)->first();
        $id->update($request->all());

        if($id){
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Di Update',
                'data' => $id
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Di Update',
                'data' => ''
            ], 404);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = $this->order_detail->where('id_order_detail', $id);
        $product->delete();

        if($product){
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil DiHapus',
                
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal DiHapus',
                
            ], 404);
        }
     }
}
