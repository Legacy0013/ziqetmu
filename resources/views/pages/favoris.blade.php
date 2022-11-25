@extends('layout.layout')

@section('content')
    <div class="container-album favoris">
{{--        <h2>Albums Likés</h2>--}}
{{--        <div class="bottom">--}}
{{--            @foreach ($albums as $album)--}}
{{--                @if (in_array($album->id, $likedAlbums->pluck('album_id')->all()))--}}
{{--                    <div class="titre">--}}
{{--                        <a href="{{ route('album', $album->id) }}">--}}
{{--                            <img src="../storage/{{ $album->picture }}" alt="">--}}
{{--                        </a>--}}
{{--                        <div class="track-infos">--}}
{{--                            <div class="wrap">--}}
{{--                                <span class="album">{{ $album->name }}</span>--}}

{{--                                @foreach ($artistes as $artiste)--}}
{{--                                    @if($album->artiste_id == $artiste->id)--}}
{{--                                        <span class="track">{{ $artiste->name }}</span>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <span class="like">--}}
{{--                            <form action="{{ route('likePlayerFavoris', $album->id) }}" method="post" id="likePlaylist">--}}
{{--                            @csrf--}}
{{--                                @if ($liked == true)--}}
{{--                                    <div class="wrapPlaylist liked">--}}
{{--                                        <input type="hidden" name="album_id" value="{{ $album->id }}">--}}
{{--                                        <input type="submit" class="likeAlbum" value="">--}}
{{--                                    </div>--}}
{{--                                @else--}}
{{--                                    <div class="wrapPlaylist">--}}
{{--                                        <input type="hidden" name="album_id" value="{{ $album->id }}">--}}
{{--                                        <input type="submit" class="likeAlbum" value="">--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                            </form>--}}
{{--                        </span>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        </div>--}}

        <h2>Titres Likés</h2>
        <div class="bottom">
            @foreach ($titres as $titre)
                @if (in_array($titre->id, $likedTitres->pluck('titre_id')->all()))
                <div class="titre">
                    @foreach($albums as $album)
                        @if($album->id == $titre->album_id)
                            <a href="{{ route('album', $album->id) }}">
                                <img src="../storage/{{ $album->picture }}" alt="">
                            </a>
                            <div class="track-infos">
                                <div class="wrap">
                                    <span class="album">{{ $album->name }}</span>

                                   @foreach ($artistes as $artiste)
                                       @if($titre->artiste_id == $artiste->id)
                                           <span class="artiste">{{ $artiste->name }}</span>
                                       @endif
                                   @endforeach
                                </div>

                                <br>

                                <span class="track">{{ $titre->name }}</span>
                           @endif
                        @endforeach
                    </div>
                    <span class="like">
                        <form action="{{ route('likeFavoris', $album->id) }}" method="post" class="likeTitre">
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
    </div>
@endsection
