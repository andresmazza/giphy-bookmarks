
<?php

use App\Support\ApiRequest;
use App\Support\GiphyApiClient;


beforeEach(function () {
    Http::fake();
    config([
        'giphy.base_url' => 'https://example.com',
        'giphy.api_key' => 'API_KEY_VALUE',
    ]);
});

it('Check if the api client sets the api key', function () {
    $request = ApiRequest::get('search');

    app(GiphyApiClient::class)->send($request);

    Http::assertSent(static function ($request) {
        expect($request)->url()->toContain('key=API_KEY_VALUE');

        return true;
    });
});

it('check if the api client sets the base url', function () {


    $request = ApiRequest::get('search');

     app(GiphyApiClient::class)->send($request);

     Http::assertSent(static function ($request) {
        expect($request)->url()->toStartWith('https://example.com/search');

        return true;
    });
});

