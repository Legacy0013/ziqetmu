<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Genre;
use App\Models\Titre;
use App\Models\Recent;
use App\Models\Artiste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function showHomepage() {
        if (auth()->check()) {
            $genres = Genre::all();
            $artistes = Artiste::all();

            $recents = Recent::where('user_id', Auth::user()->id )->groupBy('id')->get();

            if(count($recents) > 0) {
                for ($i=0; $i < count($recents); $i++) {
                    $albums[] =  Album::findOrFail($recents[$i]['album_id']);
                }
            }
            else {
                $albums = Album::all();
            }
            return view('pages.home', compact('genres', 'albums', 'artistes', 'recents'));
        } else {
            return view('layouts.guest');
        }

    }
}
