<?php

namespace App\Providers;

use App\Models\Like;
use App\Models\Album;
use App\Models\Titre;
use App\Models\Recent;
use App\Models\Artiste;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('*',function($view){
            $album = Recent::orderBy('id', 'DESC')->first();

            $titres = Titre::all();

            $view->with('titres', $titres);
        });
    }
}
