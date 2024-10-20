<?php

/** to avoid any real requests to the api */
beforeEach(function () {
    Http::fake();
});

it('when a request is made to api/gifs/search, it returns a successful response', function () {
    $response = $this->get('api/gifs/search');
  
    $response->assertStatus(200);
});


// it('when a bad request is made it, it returns a bad request', function () {
//     $response = $this->get('api/gifs/badsearch');
  
//     $response->assertStatus(404);
// });