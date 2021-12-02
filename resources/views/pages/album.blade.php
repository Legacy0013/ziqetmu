@extends('layout.layout')

@section('content')
<div class="container-album">
    @foreach ($artiste as $art)
        <div class="top">
            <img src="../storage{{ $album->picture }}" alt="">
            <h2 class="album_name">{{ ucfirst($album->name) }}</h2>
            <h2 class="artiste_name">par {{ $art->name }}</h2>
            <h3 class="album_genre">{{ ucfirst($album->genre->name ) }} ></h3>
            <p>
                <span>{{ count($titres) }} titres</span> -
                <span>{{ $album->duration }} min</span> -
                <span>{{ $album->date }}</span>
            </p>
            <div class="wrap-forms">
                <form action="{{ route('like', $album->id) }}" method="post" id="like">
                    @csrf
                    @if ($liked == true)
                        <div class="wrap liked">
                            <input type="hidden" name="album_id" value="{{ $album->id }}">
                            <input type="submit" id="likeAlbum" value="ajouter">
                        </div>
                    @else
                        <div class="wrap">
                            <input type="hidden" name="album_id" value="{{ $album->id }}">
                            <input type="submit" id="likeAlbum" value="ajouter">
                        </div>
                    @endif
                </form>
                <form action="{{ route('recent.store', $album) }}" method="post" >
                    @csrf
                    <div class="wrapListen">
                        <input type="submit" value="écouter">
                        <input type="hidden" name="album_id" value="{{ $album->id }}">
                        <input type="hidden" name="artiste_id" value="{{ $album->artiste_id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </div>
                </form>
            </div>
        </div>
        <div class="bottom">
            @foreach ($titres as $titre)
                @if ($titre->album_id == $album->id)
                    <div class="titre">
                        <span class="number">
                            {{ str_pad($titre->order, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <span class="titre_name">
                            {{ $titre->name }}
                        </span>
                        <span class="like">
                            <form action="{{ route('like', $album->id) }}" method="post" class="likeTitre">
                                @csrf
                                @if (in_array($titre->id, $likedTitres->pluck('titre_id')->all()))
                                    <div class="wrapTitre liked">
                                        <input type="hidden" name="titre_id" value="{{ $titre->id }}">
                                        <input type="submit" value="">
                                    </div>
                                @else
                                    <div class="wrapTitre">
                                        <input type="hidden" name="titre_id" value="{{ $titre->id }}">
                                        <input type="submit" value="">
                                    </div>
                                @endif
                            </form>
                        </span>
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach
</div>
@endsection
