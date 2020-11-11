<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use Cloudinary\Uploader;
class MenuController extends Controller
{

    public function __construct(\App\Menu $menu){
        $this->menu = $menu;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = $this->menu->paginate(12);
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
        $id_kategori = $request->input('id_kategori');
        $menu = $request->input('menu');
        $gambar = $request->file('gambar');
        $harga = $request->input('harga');
        $user = (object) ['gambar' => ""];
        if($request->hasFile('gambar')){
            $original_filename = $request->file('gambar')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload/image/';
            $image = strtolower($menu) . '.' . $file_ext;

            if ($request->file('gambar')->move($destination_path, $image)) {
                $img = $user->gambar = '/upload/image/' . $image;
                $data = Menu::create([
                        'id_kategori' => $id_kategori,
                        'menu' => $menu,
                        'gambar' => $img,
                        'harga' => $harga
                    ]);
            
                    return response()->json([
                        'success' => true,
                        'message' => 'Data Berhasil Ditambah',
                        'data' => $data
                        
                    ], 200);
            } else {
                return response()->json([
                    'message' => 'Tambah Data Gagal'
                ], 404);
            }
        }

        // $extension = $gambar->getClientOriginalExtension();
        //$image = Uploader::upload($gambar->getRealPath(), ['public_id' => strtolower($menu), 'folder' => 'images']);
        // if ($gambar){
        //     $cloudder = Uploader::upload($request->file('gambar')->getRealPath());
            
        //     $file_url = $cloudder["url"];
        //     // return response()->json(['file_url' => $file_url], 200);
        // $data = Menu::create([
        //     'id_kategori' => $id_kategori,
        //     'menu' => $menu,
        //     'gambar' => $file_url,
        //     'harga' => $harga
        // ]);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Data Berhasil Ditambah',
        //     'data' => $data
            
        // ], 200);
        // }
        
        // $input = $request->all();
        // if($input->gambar){

        // }
        
        // $post = $this->menu->create($input);
        // if($post){
        //     return response()->json(
        //         [
        //             'success' => true,
        //             'message' => 'Tambah Data Berhasil',
        //             'data' => $post
        //         ], 200
        //     );
        // }else{
        //     return response()->json(
        //         [
        //             'success' => false,
        //             'message' => 'Tambah Data Gagal',
        //             'data' => ''
        //         ], 404
        //     );
        // }
    }

    
        

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $post = Menu::where('id_menu', $id)->first();
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

    public function showKategori($id_kategori){
        $idkategori = Menu::where('id_kategori', $id_kategori)->get();
        if($idkategori){
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Ditemukan',
                'data' => $idkategori
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ditemukan',
                'data' => ''
            ], 404);
        }
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
        
        $id = Menu::where('id_menu', $id)->first();
        $id_kategori = $request->input('id_kategori');
        $menu = $request->input('menu');
        $gambar = $request->file('gambar');
        $harga = $request->input('harga');
        $user = (object) ['gambar' => ""];

        

        
        
        if($request->hasFile('gambar')){
            $original_filename = $gambar->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload/image/';
            $image = 'Update-' . time() . '.' . $file_ext;

            if ($request->file('gambar')->move($destination_path, $image)) {

            $img = $user->gambar = '/upload/image/' . $image;           
            
            $id->update(
                [
                    
                    'gambar' => $img
                    
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Di Update',
                'data' => $id
            ], 200);
            }    
            
            
            
        } 
        
        $id->update([
            'id_kategori' => $id_kategori,
            'menu' => $menu,
            'harga' => $harga,

        ]);

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
        $product = $this->menu->where('id_menu', $id);
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
