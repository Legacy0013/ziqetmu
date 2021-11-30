<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Album;
use App\Models\Titre;
use App\Models\Artiste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
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
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        $liked = Like::where('user_id', Auth::user()->id)
                        ->where('album_id', $album->id)
                        ->first();
        $titres = Titre::where('album_id', $album->id)->get();
        $artiste = Artiste::where('id', $album->artiste_id)->get();

        return view('pages.album', compact('album', 'artiste', 'titres', 'liked'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        //
    }
}
