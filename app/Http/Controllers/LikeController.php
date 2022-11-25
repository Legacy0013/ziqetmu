<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artiste;
use App\Models\Like;
use App\Models\Titre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
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
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album, Artiste $artiste, Titre $titre, Like $like)
    {
        $albums = Album::all();
        $artistes = Artiste::all();
        $likedTitres = Like::where('user_id', Auth::user()->id)
            ->whereNotNull('titre_id')
            ->get();
        $likedAlbums = Like::where('user_id', Auth::user()->id)
            ->whereNotNull('album_id')
            ->get();

        return view('pages.favoris', compact('likedTitres', 'likedAlbums', 'albums', 'album', 'artistes' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
    }
}
