<?php
namespace App\Services;
use App\Support\ApiRequest;
use App\Support\GiphyApiClient;

class GiphyService
{


    public function __construct(public GiphyApiClient $client)
    {
    }

    public function search(string $query, $limit = 10, $offset = 0)
    {
        $clientRequest = ApiRequest::get('gifs/search')
            ->setQuery('q', $query)
            ->setQuery('limit', $limit)
            ->setQuery('offset', $offset);
        return $this->client->send($clientRequest);

    }


    public function favorite($userId, $giphyId, $alias)
    {
        $request = ApiRequest::post('user/favorites')
            ->setBody('gif_id', $giphyId);
         
        return $this->client->send($request);
    }


    public function findById($giphyId)
    {
        try {
            $resp = $this->client->send(ApiRequest::get("gifs/" . $giphyId));
        } catch (\Illuminate\Http\Client\RequestException $e) {
            $resp = $e->response;
        }

        return $resp;
    }

    public function exist($giphyId) {

        $resp = $this->findById($giphyId);
        if ($resp->status() == 200 && $resp->json()['data'] && $resp->json()['data']['id'] == $giphyId) {
            return true;
        }
        return false;
    }

}
