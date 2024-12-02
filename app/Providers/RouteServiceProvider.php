<?php
/*
namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouterServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

Class RouterServiceProvider extends ServiceProvider
{
    protected $namespace =  "App\Http\Controllers";
    /** 
     * 
     * @var string
    */
/*
    public const HOME = '/home';

    public function boot(): void
    {
        RateLimiter::for('api',function (Request $request){
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function (){
            Route::middelware('api')
                ->prefix('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middelware('web')
                ->group(base_path('routes/web.php'));
        });
    }
    

}*/



namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    //protected $namespace = 'App\Http\Controllers\Api';
    /**
     * The namespace for the controller routes.
     *
     * @var string
     */
    

    /**
     * This is the path for the home route.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        // Set up API rate limiting.
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            // Define API routes.
            Route::middleware('api')
                ->prefix('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            // Define web routes.
            Route::middleware('web')
                //->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }
}
