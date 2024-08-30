<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use app\Helper\Logger;

class AfterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
    //    if($response->getStatusCode())
    //    {
    //     Logger::info('responseContent', $response->getContent());
    //    }
        
         Logger::info('responseContent', $response->getStatusCode());
       
        return $response;
    }
}
