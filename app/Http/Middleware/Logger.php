<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use App\Models\Log;
use Symfony\Component\HttpFoundation\Response;

class Logger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        return $next($request);
    }
    public function terminate(Request $request, Response $response)
    {
        Log::create([
            'user_id' => Auth::id(),
            'service' => $request->path(),
            'request' => $request->getContent(),
            'status' => $response->getStatusCode(),
            'response' => $response->getContent(),
            'ip' => $request->ip(),
        ]);
        
    }
}
