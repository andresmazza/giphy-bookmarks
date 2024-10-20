<?php

namespace App\Support;

/**
 * The ApiRequest class is a utility for building HTTP requests to an API.
 * It provides methods for setting the HTTP method, URI, headers, query
 * parameters, and body of the request.
 * It also provides methods for getting these properties, as well as for
 * clearing the headers, query parameters, and body.
 * Additionally, it provides static methods for creating ApiRequest instances
 * for specific HTTP methods.
 */
class ApiRequest
{
    // Store the headers that will be sent with the API request.
    protected array $headers = [];

    // Store any query string parameters.
    protected array $query = [];

    // Store the body of the request.
    protected array $body = [];

    /**
     * Create an API request for a given HTTP method and URI.
     */
    public function __construct(protected HttpMethod $method = HttpMethod::GET, protected string $uri = '')
    {
    }

    /**
     * Set headers for the request.
     * This accepts either a key and value, or an array of key/value pairs.
     */
    public function setHeaders(array|string $key, string $value = null): static
    {
        if (is_array($key)) {
            $this->headers = $key;
        } else {
            $this->headers[$key] = $value;
        }

        return $this;
    }

    /**
     * Clear headers for the request.
     * This method can clear a specific header or all headers in the request if
     * a key is not provided.
     */
    public function clearHeaders(string $key = null): static
    {
        if ($key) {
            unset($this->headers[$key]);
        } else {
            $this->headers = [];
        }

        return $this;
    }

    /**
     * Set query parameters for the request.
     * This accepts either a key and value, or an array of key/value pairs.
     */
    public function setQuery(array|string $key, string $value = null): static
    {
        if (is_array($key)) {
            $this->query = $key;
        } else {
            $this->query[$key] = $value;
        }

        return $this;
    }

    /**
     * Clear query parameters for the request.
     * This method can clear a specific parameter or all parameters if a key is
     * not provided.
     */
    public function clearQuery(string $key = null): static
    {
        if ($key) {
            unset($this->query[$key]);
        } else {
            $this->query = [];
        }

        return $this;
    }

    /**
     * Set body data for the request.
     * This accepts either a key and value, or an array of key/value pairs.
     */
    public function setBody(array|string $key, string $value = null): static
    {
        if (is_array($key)) {
            $this->body = $key;
        } else {
            $this->body[$key] = $value;
        }

        return $this;
    }

    /**
     * Clear body data for the request.
     * This method can clear a specific key of data or all data.
     */
    public function clearBody(string $key = null): static
    {
        if ($key) {
            unset($this->body[$key]);
        } else {
            $this->body = [];
        }

        return $this;
    }

    /**
     * This method returns the headers for the API request.
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * This method returns the query for the API request.
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * This method returns the body for the API request.
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * This method returns the URI for the API request.
     * If the query is empty, or we have a GET request, the URI can be returned
     * as is.
     * Otherwise, we need to append the query string to the URI.
     */
    public function getUri(): string
    {
        if (empty($this->query) || $this->method === HttpMethod::GET) {
            return $this->uri;
        }

        return $this->uri.'?'.http_build_query($this->query);
    }

    /**
     * This method returns the HTTP method for the API request.
     */
    public function getMethod(): HttpMethod
    {
        return $this->method;
    }

    // The following methods are used to create API requests for specific HTTP
    // methods.

    public static function get(string $uri = ''): static
    {
        return new static(HttpMethod::GET, $uri);
    }

    public static function post(string $uri = ''): static
    {
        return new static(HttpMethod::POST, $uri);
    }

    public static function put(string $uri = ''): static
    {
        return new static(HttpMethod::PUT, $uri);
    }

    public static function delete(string $uri = ''): static
    {
        return new static(HttpMethod::DELETE, $uri);
    }
}