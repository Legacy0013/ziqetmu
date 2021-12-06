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
            $titres = Titre::all();

            if(isset(Auth::user()->id)){
                $recents = Recent::where('user_id', Auth::user()->id )
                ->get();

                if(count($recents) > 0) {
                    $lastRecent = Recent::where('user_id', Auth::user()->id )
                    ->orderBy('created_at', 'desc')
                    ->first();

                    $lastAlbum = Album::where('id', $lastRecent->album_id)
                    ->first();

                    $liked = Like::where('user_id', Auth::user()->id)
                    ->where('album_id', $lastAlbum->id)
                    ->first();
                } else {
                    $lastRecent = [];
                    $lastAlbum = [];
                    $likedTitres = [];
                    $liked = [];
                }

                $titresId = $titres->pluck('id');

                $likedTitres = Like::where('user_id', Auth::user()->id)
                ->whereIn('titre_id', $titresId)
                ->get();
            } else {
                $lastRecent = [];
                $lastAlbum = [];
                $likedTitres = [];
                $liked = [];
            }

            $view->with('titres', $titres)
                ->with('lastRecent', $lastRecent)
                ->with('lastAlbum', $lastAlbum)
                ->with('liked', $liked)
                ->with('likedTitres', $likedTitres);
        });
    }

}

