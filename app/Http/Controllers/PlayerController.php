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
    public function show(Album $album, Titre $titre)
    {
        // $liked = Like::where('user_id', Auth::user()->id)
        //                 ->where('album_id', $album->id)
        //                 ->first();

        // $titreCount = Titre::all();

        // $titres = Titre::where('album_id', $album->id)->get();

        // $titresId = $titres->pluck('id');

        // $artiste = Artiste::where('id', $album->artiste_id)->get();

        // $likedTitres = Like::where('user_id', Auth::user()->id)
        //                     ->whereIn('titre_id', $titresId)
        //                     ->get();

        // return view('pages.player', compact('album', 'artiste', 'titres', 'titreCount', 'liked', 'likedTitres'));
    }

    //ajouter ou supprimer un like sur un album ou un titre
    public function like(Request $request, Album $album, Like $like)
    {
        if($request->has('album_id')){
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

        if($request->has('titre_id')) {
            $likedTitre = Like::where('user_id', Auth::user()->id)
            ->where('titre_id', $request->titre_id)
            ->first();

            $like->user_id = Auth::user()->id;
            $like->titre_id = $request->titre_id;

            if(!isset($likedTitre)) {
                $like->save();
                $likedTitre = true;
            } else {
                $likedTitre->delete();
                $likedTitre = false;
            }
            return response()->json(['likedTitre'=>$likedTitre]);
        }
    }
}
