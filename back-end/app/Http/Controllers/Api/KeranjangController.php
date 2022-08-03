<?php

namespace App\Http\Controllers\Api;

use App\Models\Keranjang;
use App\Models\Meja;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\KeranjangResource;
use Illuminate\Support\Facades\Validator;


class KeranjangController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $keranjang = Keranjang::latest()->paginate(5);

        //return collection of posts as a resource
        return new KeranjangResource(true, 'List Data Keranjang', $keranjang);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_meja'     => 'required',
            'id_menu'     => 'required|unique:keranjang',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $keranjang = new Keranjang([
            'no_meja'     => $request->no_meja,
            'id_menu'     => $request->id_menu,
        ]);
 
        $meja = Meja::find($request->no_meja);
        $meja->MenudiKeranjang()->save($keranjang);

        //return response
        return new KeranjangResource(true, 'Menu Berhasil Ditambahkan ke Keranjang!', $keranjang);
    }
        
    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show($id)
    {
        $result = Keranjang::join('menu', 'keranjang.id_menu', '=', 'menu.id_menu')
                ->where('no_meja', $id)->get();
        //return single post as a resource
        return new KeranjangResource(true, 'Data Keranjang Ditemukan!', $result);
    }
    
    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy(Request $request)
    {

        //delete menu dari keranjang
        $delete = Keranjang::where('no_meja', $request->no_meja)
                ->where('id_menu', $request->id_menu)->delete();

        //return response
        return new KeranjangResource(true, 'Menu Berhasil Dihapus dari keranjang!', $delete);
    }
}