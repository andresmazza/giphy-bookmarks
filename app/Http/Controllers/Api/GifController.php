<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\GiphyService;
use Illuminate\Http\Request;


class GifController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected GiphyService $giphyService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {

        $query = $request->input('query');
        $limit = $request->input('limit', '10');
        $offset = $request->input('offset', '0');

        $resp = $this->giphyService->search($query, $limit, $offset);

        return response(json_decode($resp, true), $resp->status());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $request->validate([
            'id' => 'required|string',
            'alias' => 'required|string'
        ]);

        $resp = $this->giphyService->favorite($userId, $request->id, $request->alias);

        return response(null, $resp->status());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $response = $this->giphyService->show($id);
        
        return response($response->body(), $response->status());

    }


}
