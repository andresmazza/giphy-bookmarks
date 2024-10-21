<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\GiphyService;
use Illuminate\Http\Request;
use App\Models\Gif;
use Validator;


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
        $limit = $request->input('limit',  config('giphy.defualt_items_per_page'));
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
        $validator = Validator::make($request->all(), [
            'id' => 'required|string',
            'alias' => 'required|string',
            'user_id' => 'required|integer',
        ]);



        if ($validator->fails()) {
            return response(['message' => 'Validation error', 'errors' => $validator->errors()], 400);
        }
        if ($request->input('user_id') != $userId) {
            return response([
                'message' => 'Validation error',
                'errors' => [
                    "user_id" =>
                        "The entered user does not match with the logged in user."
                ]
            ], 400);
        }

        if (!$this->giphyService->exist($request->id)) {
            return response([
                'message' => 'Validation error',
                'errors' => [
                    "id" =>
                        "Invalid gif id."
                ]
            ], 400);
        }


        $count = Gif::where(['id' => $request->id, 'user_id' => $userId])->count();
        if ($count > 0) {
            return response(['message' => 'The item already exists'], 400);
        }

        Gif::create(['id' => $request->id, 'alias' => $request->alias, 'user_id' => $userId]);

        return response("Created", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $response = $this->giphyService->findById($id);

        return response($response->body(), $response->status());

    }


}
