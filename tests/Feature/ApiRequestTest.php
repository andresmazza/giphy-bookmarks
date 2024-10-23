<?php

use App\Support\ApiRequest;
use App\Support\HttpMethod;

it('sets request data properly', function () {
    $request = (new ApiRequest(HttpMethod::GET, '/'))
        ->setHeaders(['foo' => 'bar'])
        ->setQuery(['baz' => 'qux'])
        ->setBody(['quux' => 'quuz']);

    expect($request)
        ->getHeaders()->toBe(['foo' => 'bar'])
        ->getQuery()->toBe(['baz' => 'qux'])
        ->getBody()->toBe(['quux' => 'quuz'])
        ->getMethod()->toBe(HttpMethod::GET)
        ->getUri()->toBe('/');
});

it('sets request data properly with a key->value', function () {
    $request = (new ApiRequest(HttpMethod::GET, '/'))
        ->setHeaders('foo', 'bar')
        ->setQuery('baz', 'qux')
        ->setBody('quux', 'quuz');

    expect($request)
        ->getHeaders()->toBe(['foo' => 'bar'])
        ->getQuery()->toBe(['baz' => 'qux'])
        ->getBody()->toBe(['quux' => 'quuz'])
        ->getMethod()->toBe(HttpMethod::GET)
        ->getUri()->toBe('/');
});

it('clears request data properly', function () {
    $request = (new ApiRequest(HttpMethod::GET, '/'))
        ->setHeaders(['foo' => 'bar'])
        ->setQuery(['baz' => 'qux'])
        ->setBody(['quux' => 'quuz']);

    $request->clearHeaders()
        ->clearQuery()
        ->clearBody();

    expect($request)
        ->getHeaders()->toBe([])
        ->getQuery()->toBe([])
        ->getBody()->toBe([])
        ->getUri()->toBe('/');
});

it('clears request data properly with a key', function () {
    $request = (new ApiRequest(HttpMethod::GET, '/'))
        ->setHeaders('foo', 'bar')
        ->setQuery('baz', 'qux')
        ->setBody('quux', 'quuz');

    $request->clearHeaders('foo')
        ->clearQuery('baz')
        ->clearBody('quux');

    expect($request)
        ->getHeaders()->toBe([])
        ->getQuery()->toBe([])
        ->getBody()->toBe([])
        ->getUri()->toBe('/');
});

it('creates instance with correct method', function (HttpMethod $method) {
    $request = ApiRequest::{$method->value}('/');

    expect($request->getMethod())->toBe($method);
})->with([
    [HttpMethod::GET],
    [HttpMethod::POST],
    [HttpMethod::PUT],
    [HttpMethod::DELETE],
]);