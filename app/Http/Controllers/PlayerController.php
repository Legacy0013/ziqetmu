<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Titre;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function show()
    {
        $titres = Titre::all();
        $nbrTitresAlbum = Album::where('id', $titres->album_id);

        return view('pages.player', compact('nbrTitresAlbum'));
    }
}
