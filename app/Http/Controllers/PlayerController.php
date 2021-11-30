<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Album;
use App\Models\Titre;
use App\Models\Artiste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    public function show(Album $album)
    {
        $liked = Like::where('user_id', Auth::user()->id)
        ->where('album_id', $album->id)
        ->first();
        $titreCount = Titre::where('album_id', $album->id)->get();
        $titres = Titre::all();
        $artiste = Artiste::where('id', $album->artiste_id)->get();

        return view('pages.player', compact('album', 'artiste', 'titres', 'titreCount', 'liked'));
    }

    //ajouter ou supprimer un like sur un album
    public function like(Request $request, Album $album, Like $like)
    {
        $liked = Like::where('user_id', Auth::user()->id)
                        ->where('album_id', $album->id)
                        ->first();


        $like->user_id = Auth::user()->id;
        $like->album_id = $request->album_id;

        if(!isset($liked)) {
            $like->save();
            $liked = true;
        } else {
            $liked->delete();
            $liked = false;
        }

        return response()->json(['liked'=>$liked]);
    }
}
