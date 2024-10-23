<?php

use App\Support\ApiClient;
use App\Support\ApiRequest;
use App\Support\HttpMethod;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\assertTrue;

beforeEach(function () {
    Http::fake();

    $this->client = new class extends ApiClient
    {
        protected function baseUrl(): string
        {
            return 'https://example.com';
        }
    };
});


it('sends a get request', function () {
    $request = ApiRequest::get('foo')
        ->setHeaders(['X-Foo' => 'Bar'])
        ->setQuery(['baz' => 'qux']);

    $this->client->send($request);

    Http::assertSent(static function (Request $request) {
        expect($request)
            ->url()->toBe('https://example.com/foo?baz=qux')
            ->method()->toBe(HttpMethod::GET->name)
            ->header('X-Foo')->toBe(['Bar']);

        return true;
    });

});

it('sends a post request', function () {
    $request = ApiRequest::post('foo')
        ->setBody(['foo' => 'bar'])
        ->setHeaders(['X-Foo' => 'Bar'])
        ->setQuery(['baz' => 'qux']);

    $this->client->send($request);

    Http::assertSent(static function (Request $request) {
        expect($request)
            ->url()->toBe('https://example.com/foo?baz=qux')
            ->method()->toBe(HttpMethod::POST->name)
            ->data()->toBe(['foo' => 'bar'])
            ->header('X-Foo')->toBe(['Bar']);

        return true;
    });
});

it('sends a put request', function () {
    $request = ApiRequest::put('foo')
        ->setBody(['foo' => 'bar'])
        ->setHeaders(['X-Foo' => 'Bar'])
        ->setQuery(['baz' => 'qux']);

    $this->client->send($request);

    Http::assertSent(static function (Request $request) {
        expect($request)
            ->url()->toBe('https://example.com/foo?baz=qux')
            ->method()->toBe(HttpMethod::PUT->name)
            ->data()->toBe(['foo' => 'bar'])
            ->header('X-Foo')->toBe(['Bar']);

        return true;
    });
});

it('sends a delete request', function () {
    $request = ApiRequest::delete('foo')
        ->setBody(['foo' => 'bar'])
        ->setHeaders(['X-Foo' => 'Bar'])
        ->setQuery(['baz' => 'qux']);

    $this->client->send($request);

    Http::assertSent(static function (Request $request) {
        expect($request)
            ->url()->toBe('https://example.com/foo?baz=qux')
            ->method()->toBe(HttpMethod::DELETE->name)
            ->data()->toBe(['foo' => 'bar'])
            ->header('X-Foo')->toBe(['Bar']);

        return true;
    });
});

it('handles authorization', function () {
    $client = new class extends ApiClient
    {
        protected function baseUrl(): string
        {
            return 'https://example.com';
        }

        protected function authorize(PendingRequest $request): PendingRequest
        {
            return $request->withHeaders(['Authorization' => 'Bearer foo']);
        }
    };

    $request = ApiRequest::get('foo');

    $client->send($request);

    Http::assertSent(static function (Request $request) {
        expect($request)->header('Authorization')->toBe(['Bearer foo']);

        return true;
    });
});