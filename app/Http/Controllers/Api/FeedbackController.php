<?php

namespace App\Http\Controllers\Api;

use App\Models\Feedback;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


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
        $feedback = Feedback::latest()->paginate(5);

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
}