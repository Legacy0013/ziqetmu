<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Recent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecentController extends Controller
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
    public function store(Request $request, Recent $recent, Album $album)
    {
        $recents = Recent::where('user_id', Auth::user()->id)
                            ->where('album_id', $request->album_id)
                            ->first();

        $request->validate([
            'user_id' => 'required',
            'album_id' => 'required',
            'artiste_id' => 'required'
            ]);

            $recent->user_id = $request->user_id;
            $recent->album_id = $request->album_id;
            $recent->artiste_id = $request->artiste_id;


            if(!isset($recents)) {
                $recent->save();
                $recents = true;
            } else {
                $recent->delete();
                $recents = false;
            }

            return redirect()->route('player', $recent->album_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recent  $recent
     * @return \Illuminate\Http\Response
     */
    public function show(Recent $recent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recent  $recent
     * @return \Illuminate\Http\Response
     */
    public function edit(Recent $recent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recent  $recent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recent $recent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recent  $recent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recent $recent)
    {
        //
    }
}
