<?php

namespace App\Http\Controllers\Api;

use App\Models\Feedback;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\PesananController;
use Illuminate\Support\Facades\Validator;


class FeedbackController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $feedback = Feedback::get();

        //return collection of posts as a resource
        return response()->json([
            'message' => 'List daftar feedback',
            'data'    => $feedback,
        ]);
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
            'id_pesanan'     => 'required',
            'isi_feedback'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $feedback = new Feedback([
            'id_pesanan'     => $request->id_pesanan,
            'isi_feedback'   => $request->isi_feedback,
        ]);
 
        $pesanan = Pesanan::find($request->id_pesanan);
        $pesanan->feedback()->save($feedback);

        //return response
        return response()->json([
            'message' => 'Sukses ditambahkan',
            'data'    => $feedback,
        ]);
    }
        
    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show($id_pesanan)
    {
        $feedback = Pesanan::find($id_pesanan)->feedback()->get();
        //return single post as a resource
        return response()->json([
            'message' => 'Feedback dari id pesanan '. $id_pesanan,
            'data'    => $feedback,
        ]);
    }
    
    // public function belum_isi($no_meja)
    // {
    //     $pesanan=new PesananController();
    //     $f_pesanan=$pesanan->pesanan_feedback($no_meja);
    //     $feedback=Feedback::get();

    //     $data=array();
    //     for()
    //     if($f_pesanan->id_pesanan)

    //     dd($pesanan->pesanan_feedback($no_meja));

    // }
}