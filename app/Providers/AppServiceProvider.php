<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\App;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
<<<<<<< HEAD
        if(\APP::environment(['production'])){
            \URL::force('https');
        }
=======
        // if(App::environment(['production'])) {
        //    \URL::forseScheme('https');
        // }
>>>>>>> b78e404d81a521078fe901c5410c3f3672060e10
    }
    
}
