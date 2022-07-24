<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;


class FeedbackController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view('user.feedback', ['data' => ['success' => false]]);
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
                        'id_pesanan' => 1,
                        'isi_feedback' => $request->isi_feedback,
                    )
                )
            );
        $data=json_decode($response->getBody()->getContents())->message;
        
        return view('user.feedback', ['data' => ['success' => true , 'message' => $data]]);
    }
}