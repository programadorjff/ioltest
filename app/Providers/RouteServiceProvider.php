<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
	/*protected $namespace = null;*/

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //
        
    	/*
    	 |--------------------------------------------------------------------------
    	 | Authentication Filters
    	 |--------------------------------------------------------------------------
    	 |
    	 | The following filters are used to verify that the user of the current
    	 | session is logged into this application. The "basic" filter easily
    	 | integrates HTTP Basic authentication for quick, simple checking.
    	 |
    	 */
    	
		$router->filter('auth.basic', function () {
    		return Auth::basic();
    	});
    	
    	/*
    	 |--------------------------------------------------------------------------
    	 | Guest Filter
    	 |--------------------------------------------------------------------------
    	 |
    	 | The "guest" filter is the counterpart of the authentication filters as
    	 | it simply checks that the current user is not logged in. A redirect
    	 | response will be issued if they are, which you may freely change.
    	 |
    	 */
    	
    	$router->filter('guest', function () {
    		if (Auth::check()) {
    			return Redirect::to('/');
    		}
    	});
    	
        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
