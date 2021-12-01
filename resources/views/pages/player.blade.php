@extends('layout.layout')

@section('content')
    <div class="container-player">
        <input type="hidden" name="album_id" id="album_id" value="{{ $album->id }}">
        <h2>{{ $album->name }}</h2>
        <img class="cover" src="../storage/albums/covers/{{ $album->id }}/cover.jpg" alt="">
        <form action="{{ route('likePlayer', $album->id) }}" method="post" id="like">
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
        <div class="audio-player">
            <div class="time">
                <div class="current">00:00</div>
                <div class="length"></div>
            </div>
            <div class="timeline">
                <div class="progress"></div>
            </div>
            <div class="titre_name_container">
                <span class="titre_name">{{ $album->titre[0]->name }}</span>
            </div>
            <div class="wrap-name">
                <div class="textSlide2">
                    <div class="album-name">{{ $album->name }}</div>
                    <div class="separator"></div>
                    <div class="artiste_name">{{ $album->artiste->name }}</div>
                </div>
            </div>
            <div class="controls">
                <div class="loop"></div>
                <div class="prev"></div>
                <div class="play-container">
                    <div class="toggle-play play"></div>
                </div>
                <div class="next"></div>
                <div class="shuffle"></div>
            </div>
            <div class="queue"><span>File d'attente</span></div>
        </div>
        <div class="titres-list">
            {{-- <div class="close"></div> --}}
            <div class="infos">
                <h2>à l'écoute</h2>
                <div class="wrap-infos">
                    <div class="titres_count"></div>
                    <p>{{ count($titres) }} titres</p>
                    <div class="separator"></div>
                    <div class="duration">{{ $album->duration }} min</div>
                </div>
            </div>
            <div class="currentSong">
                <span class="album-cover">
                    <img src="../storage/{{ $album->picture }}" alt="">
                </span>
                <span class="current-track">
                    <span class="current-song"></span>
                    <div class="wrap-name">
                        <div class="textSlide">
                            <div class="album_name">{{ $album->name }}</div>
                            <div class="separator"></div>
                            <div class="artiste_name">{{ $album->artiste->name }}</div>
                        </div>
                    </div>
                </span>
                <span class="like">
                    <form action="{{ route('likePlayer', $album->id) }}" method="post" id="likePlaylist">
                        @csrf
                        @if ($liked == true)
                            <div class="wrapPlaylist liked">
                                <input type="hidden" name="album_id" value="{{ $album->id }}">
                                <input type="submit" id="likeAlbum" value="">
                            </div>
                        @else
                            <div class="wrapPlaylist">
                                <input type="hidden" name="album_id" value="{{ $album->id }}">
                                <input type="submit" id="likeAlbum" value="">
                            </div>
                        @endif
                    </form>
                </span>
            </div>
            <div class="albumTracks">
                @for($i=0; $i<count($titres); $i++)
                    @if($album->id == $titres[$i]->album_id)
                        <div class="titre">
                            <span class="number">
                                {{ str_pad($titres[$i]['order'], 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <span class="track">{{$titres[$i]['name']}}</span>
                            <span class="like">
                                <form action="{{ route('likePlayer', $album->id) }}" method="post" class="likeTitre">
                                    @csrf
                                    @if (in_array($titres[$i]['id'], $likedTitres->pluck('titre_id')->all()))
                                        <div class="wrapTitre liked">
                                            <input type="hidden" name="titre_id" value="{{ $titres[$i]['id'] }}">
                                            <input type="submit" value="">
                                        </div>
                                    @else
                                        <div class="wrapTitre">
                                            <input type="hidden" name="titre_id" value="{{ $titres[$i]['id'] }}">
                                            <input type="submit" value="">
                                        </div>
                                    @endif
                                </form>
                            </span>
                        </div>

                    @endif
                @endfor
            </div>
        </div>
    </div>
@endsection
