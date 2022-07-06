<?php

namespace App\Http\Controllers\Api;

use App\Models\Meja;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MejaResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class MejaController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get Meja
        $produk = Meja::latest()->paginate(5);

        //return collection of Meja as a resource
        return new MejaResource(true, 'List Data Meja', $produk);
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
            'no_meja'         => 'required|unique:meja',
            'nama_meja'       => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        //create Meja
        $meja = Meja::create([
            'no_meja'     => $request->no_meja,
            'nama_meja'   => $request->nama_meja,
        ]);

        //return response
        return new MejaResource(true, 'Data Meja Berhasil Ditambahkan!', $meja);
    }
        
    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show(Meja $meja)
    {
        //return single post as a resource
        return new MejaResource(true, 'Data Meja Ditemukan!', $meja);
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Meja $meja)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'no_meja'         => 'required|unique:meja',
            'nama_meja'       => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        //update post without image
        $meja->update([
            'no_meja'     => $request->no_meja,
            'nama_meja'   => $request->nama_meja,
        ]);
        //return response
        return new MejaResource(true, 'Data Meja Berhasil Diubah!', $meja);
    }
    
    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy(Meja $meja)
    {

        //delete meja
        $meja->delete();

        //return response
        return new MejaResource(true, 'Data Meja Berhasil Dihapus!', null);
    }
}