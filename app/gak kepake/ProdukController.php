<?php

namespace App\Http\Controllers\Api;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ProdukController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $produk = Produk::latest()->paginate(5);

        //return collection of posts as a resource
        return new ProdukResource(true, 'List Data Produk', $produk);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'gambar'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'tipe_produk'    => 'required',
            'harga'          => 'required',
            'deskripsi'      => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload gambar
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/produk', $gambar->hashName());

        //create Kamar Hotel
        $produk = Produk::create([
            'gambar'     => $gambar->hashName(),
            'tipe_produk'=> $request->tipe_produk,
            'harga'      => $request->harga,
            'deskripsi'  => $request->deskripsi,
        ]);

        //return response
        return new ProdukResource(true, 'Data Produk Berhasil Ditambahkan!', $produk);
    }
        
    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show(Produk $produk)
    {
        //return single post as a resource
        return new ProdukResource(true, 'Data Produk Ditemukan!', $produk);
    }
    
    public function showtype(Request $request)
    {
        $kategori = $request->tipe_produk;
        $result = Produk::where('tipe_produk', $kategori)->get();
        //return single post as a resource
        return new ProdukResource(true, 'Data Produk Ditemukan!', $result);
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Produk $produk)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'gambar'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'tipe_produk'    => 'required',
            'harga'          => 'required',
            'deskripsi'      => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if image is not empty
        if ($request->hasFile('gambar')) {

            //upload image
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/produk', $gambar->hashName());

            //delete old image
            Storage::delete('public/produk/'.$produk->image);

            //update post with new image
            $produk->update([
                'gambar'     => $gambar->hashName(),
                'tipe_produk'=> $request->tipe_produk,
                'harga'      => $request->harga,
                'deskripsi'  => $request->deskripsi,
            ]);

        } else {

            //update post without image
            $produk->update([
                'tipe_produk'=> $request->tipe_produk,
                'harga'      => $request->harga,
                'deskripsi'  => $request->deskripsi,
            ]);
        }

        //return response
        return new ProdukResource(true, 'Data Produk Berhasil Diubah!', $produk);
    }
    
    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy(Produk $produk)
    {
        //delete image
        Storage::delete('public/produk/'.$produk->image);

        //delete post
        $produk->delete();

        //return response
        return new ProdukResource(true, 'Data Produk Berhasil Dihapus!', null);
    }
}