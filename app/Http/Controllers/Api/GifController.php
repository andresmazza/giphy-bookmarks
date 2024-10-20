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
     * Create a new controller instance.
     */
    public function __construct(
        protected GiphyApiClient $client
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        
        $query = $request->input('query');
        $limit = $request->input('limit','10');
        $offset = $request->input('offset','0');

        $key = config('giphy.api_key');

        // php
        //$url = "http://api.giphy.com/v1/gifs/search?q=ryan+gosling&api_key=YOUR_API_KEY&limit=5";
        // print_r(json_decode(file_get_contents($url)));

        ///ESTO VA EN UN SERVICIO
        //$client = app(GiphyApiClient::class);
        $clientRequest = ApiRequest::get('gifs/search')
           // ->setQuery('q', $query)
            ->setQuery('limit', $limit)
            ->setQuery('offset', $offset);

        $resp = $this->client->send($clientRequest);



        return response(json_decode($resp, true), $resp->status());

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::id();
        $request->validate([
            'id' => 'required|string',
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
        $clientRequest = ApiRequest::get("gifs/" . $id);

        $resp = $this->client->send($clientRequest);

        return response(json_decode($resp, true), $resp->status());

    }



}
