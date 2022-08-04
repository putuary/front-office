<?php

namespace App\Http\Controllers\User;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect;

class FeedbackController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index($no_meja)
    {
        $client = new Client();
        $request = $client->get(env('URL').'/api/pesanan/showpesananmeja/'.$no_meja);
        $response = json_decode($request->getBody()->getContents());
        #dd($response);
        $data=$response->data;
        return view('user.feedback.feedback', ['data' => $data]);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        #dd($request->all());
        $client = new Client();
        $response=$client->post(env('URL').'/api/feedback',
                array(
                    'form_params' => array(
                        'id_pesanan' => $request->id_pesanan,
                        'isi_feedback' => $request->isi_feedback,
                    )
                )
            );
        $data=json_decode($response->getBody()->getContents())->message;
        
        return redirect('/feedback/'.$request->no_meja);
    }

    public function tambah_feedback($id_pesanan)
    {
        $client = new Client();
        $request = $client->get(env('URL').'/api/pesanan/'.$id_pesanan);
        $response = json_decode($request->getBody()->getContents());
        #dd($response);
        $data=$response->data;
        return view('user.feedback.feedback_pesanan', ['data' => $data]);
    }
}