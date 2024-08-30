<?php

namespace App\Http\Middleware;

use App\Helper\Logger;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class BeforeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $requestString = "\r\n Url: ".$request->fullUrl()."\r\n Method: ".$request->method()."\r\n Header: ".json_encode($request->header())."\r\n QueryParam: ".json_encode($request->query())."\r\n BodyParam: ".json_encode($request->all())."\r\n-----------------";
         Logger::info('message',$requestString);

         Logger::info('request',$request);

        return $next($request);
    }
}
