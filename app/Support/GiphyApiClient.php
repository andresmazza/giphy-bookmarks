<?php

namespace App\Support;

use Illuminate\Http\Client\PendingRequest;

/**
 * The GiphyApiClient class is a concrete implementation of the ApiClient
 * base class for the Giphy Development API.
 * It provides methods for getting the base URL and authorizing a request
 */
class GiphyApiClient extends ApiClient
{
    /**
     * Get the base URL for the Giphy API.
     * The base URL is retrieved from the 'giphy.base_url'
     * configuration value.
     */
    protected function baseUrl(): string
    {
        return config('giphy.base_url');
    }

    /**
     * Authorize a request for the Google Books API.
     * The Giphy API accepts the API key as a query parameter named
     * 'key'.
     * The API key is retrieved from the 'services.google_books.api_key'
     * configuration value.
     */
    protected function authorize(PendingRequest $request): PendingRequest
    {
        return $request->withQueryParameters([
            'api_key' => config('giphy.api_key'),
        ]);
    }
}