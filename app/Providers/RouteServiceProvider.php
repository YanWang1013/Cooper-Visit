<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {

        $this->mapWebRoutes();

        $this->mapAccountRoutes();

        $this->mapFleetRoutes();

        $this->mapDispatcherRoutes();

        $this->mapDriverRoutes();

        $this->mapAdminRoutes();

        //
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::group([
            'middleware' => ['web', 'admin', 'cors', 'auth:admin'],
            'prefix' => 'admin',
            'as' => 'admin.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/admin.php');
        });
    }

    /**
     * Define the "driver" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapDriverRoutes()
    {
        Route::group([
            'middleware' => ['web', 'driver', 'auth:driver'],
            'prefix' => 'driver',
            'as' => 'driver.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/driver.php');
        });
    }

    /**
     * Define the "dispatcher" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapDispatcherRoutes()
    {
        Route::group([
            'middleware' => ['web', 'dispatcher', 'auth:dispatcher'],
            'prefix' => 'dispatcher',
            'as' => 'dispatcher.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/dispatcher.php');
        });
    }

    /**
     * Define the "fleet" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapFleetRoutes()
    {
        Route::group([
            'middleware' => ['web', 'fleet', 'auth:fleet'],
            'prefix' => 'fleet',
            'as' => 'fleet.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/fleet.php');
        });
    }

    /**
     * Define the "account" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAccountRoutes()
    {
        Route::group([
            'middleware' => ['web', 'account', 'cors', 'auth:account'],
            'prefix' => 'account',
            'as' => 'account.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/account.php');
        });
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => ['web', 'cors'],
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }

}
