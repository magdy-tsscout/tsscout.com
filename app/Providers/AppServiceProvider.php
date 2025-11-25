<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\View;
use App\Models\Page;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // Register the middleware manually
        $this->app['router']->aliasMiddleware('admin', AdminMiddleware::class);

        // This will share $pages variable with all views that include the header
             View::composer('header', function ($view) {
             $view->with('pages', Page::all());
         });
        
    }
}
