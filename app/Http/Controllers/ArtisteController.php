<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Album;
use App\Models\Artiste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArtisteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artiste  $artiste
     * @return \Illuminate\Http\Response
     */
    public function show(Artiste $artiste)
    {
        $nbrLikeArtiste = Like::where('artiste_id', $artiste->id)->count();
        $liked = Like::where('user_id', Auth::user()->id)
        ->where('artiste_id', $artiste->id)
        ->first();
        $albums = Album::where('artiste_id', $artiste->id)->get();
        return view('pages.artiste', compact('artiste', 'albums', 'liked', 'nbrLikeArtiste'));
    }

      //ajouter ou supprimer un like sur un artiste
      public function like(Request $request, Artiste $artiste, Like $like)
      {
          $likedArtiste = Like::where('user_id', Auth::user()->id)
                          ->where('artiste_id', $artiste->id)
                          ->first();

          $like->user_id = Auth::user()->id;
          $like->artiste_id = $request->artiste_id;

          if(!isset($likedArtiste)) {
              $like->save();
              $likedArtiste = true;
          } else {
              $likedArtiste->delete();
              $likedArtiste = false;
          }

          return response()->json(['likedArtiste'=>$likedArtiste]);
      }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artiste  $artiste
     * @return \Illuminate\Http\Response
     */
    public function edit(Artiste $artiste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artiste  $artiste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artiste $artiste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artiste  $artiste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artiste $artiste)
    {
        //
    }
}
