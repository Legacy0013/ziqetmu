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
        $genres = Genre::all();
        $artistes = Artiste::all();

        $recents = Recent::where('user_id', Auth::user()->id )->get();

        for ($i=0; $i < count($recents); $i++) {
            $albums[] =  Album::findOrFail($recents[$i]['album_id']);
        }

        return view('pages.home', compact('genres', 'albums', 'artistes', 'recents'));
    }
}
