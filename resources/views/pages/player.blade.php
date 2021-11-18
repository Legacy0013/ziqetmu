@extends('layout.layout')

@section('content')
    <div class="container-player">
        <h2>{{ $album->name }}</h2>
        <img class="cover" src="../storage/albums/covers/{{ $album->id }}/cover.jpg" alt="">
        <form action="" method="post">
            @csrf
            <div class="wrap">
                <input type="submit" value="ajouter">
            </div>
        </form>
        <div class="audio-player">
            <div class="time">
                <div class="current">00:00</div>
                <div class="length"></div>
            </div>
            <div class="timeline">
                <div class="progress"></div>
            </div>
            <div class="titre_name">{{ $album->titre[0]->name }}</div>
            <div class="wrap-name">
                <div class="album-name">{{ $album->name }}</div>
                <div class="separator"></div>
                <div class="artiste_name">{{ $album->artiste->name }}</div>
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
            <h2>à l'écoute</h2>
            <div class="infos">
                <div class="titres_count">
                    <p>{{ count($titreCount) }} titres</p>
                </div>
                <div class="separator"></div>
                <div class="duration">{{ $album->duration }} min</div>
            </div>
            <div class="currentSong">

            </div>
            @for($i=0; $i<count($titres); $i++)
                @if ($album->id == $titres[$i]->album_id)
                    <div class="titre">
                        <span class="number">
                            {{ str_pad($titres[$i]['order'], 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <span class="track">
                            {{$titres[$i]['name']}}
                        </span>
                        <span class="like">
                            {{-- @if (si le titre est liké ou non)

                            @endif --}}
                            <img src="../img/favori-active.svg" alt="">
                        </span>
                    </div>
                @endif
            @endfor
        </div>
    </div>
@endsection
