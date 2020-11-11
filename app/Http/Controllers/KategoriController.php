<?php

namespace App\Http\Controllers;
use App\Kategori ;
use Illuminate\Http\Request;


class KategoriController extends Controller
{
    public function __construct(\App\Kategori $kategori){
        $this->kategori = $kategori;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //z
        $posts = $this->kategori->paginate(10);
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
        $post = $this->kategori->create($input);
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
        
        $post = Kategori::where('id_kategori', $id)->first();
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

        $id = Kategori::where('id_kategori', $id)->first();
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
        $product = $this->kategori->where('id_kategori', $id);
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
                
            ], 400);
        }
     }
    
}
