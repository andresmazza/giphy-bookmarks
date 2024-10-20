<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Support\ApiRequest;
use App\Support\GiphyApiClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class GifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $key = config('giphy.api_key');

        // php
        //$url = "http://api.giphy.com/v1/gifs/search?q=ryan+gosling&api_key=YOUR_API_KEY&limit=5";
       // print_r(json_decode(file_get_contents($url)));
        
       ///ESTO VA EN UN SERVICIO
       $client = app(GiphyApiClient::class);
       $request = ApiRequest::get('gifs/search')
       ->setQuery('q', 'french+bulldog')
       ->setQuery('limit', 2)
       ->setQuery('offset', 0);

       $resp= $client->send($request);


        //$resp =null;
        // $resp = Http::get('http://api.giphy.com/v1/gifs/search', [
        //     'api_key' => $key,
        //     'q' => 'linux',
        //     'limit' => 1,
        //     'offset' => 0

        // ]);

        return response(json_decode($resp, true),$resp->status());

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
     {
            
             $request->validate([
             'id' => 'required|string|digits:13',
             'alias' => 'required|string'
         ]);


    //     /*$favorite = Favorite::create([
    //         'gif_id' => $request->gif_id,
    //         'alias' => $request->alias,
    //         'user_id' => Auth::id(),  // Obtener el ID del usuario autenticado
    //     ]);*/

    //     return response()->json([
    //         'message' => 'GIF agregado a favoritos exitosamente.',
    //         'favorite' => $favorite
    //     ], 201);
        return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

   
    
}
