<?php
namespace App\Providers;


use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const Home = '/home';
    protected $namespace = 'App\Http\Controllers';

    public function boot() : void
    {
       

        $this->loadRoutesFrom(base_path('routes/api.php'));
    }   

}