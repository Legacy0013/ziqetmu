@extends('layout.layout')

@section('content')
    <div class="container-player">
        <h2>{{ $album->name }}</h2>
        <img src="../storage/albums/covers/{{ $album->id }}/cover.jpg" alt="">
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
                <div class="volume-container">
                    <div class="volume-button">
                        <div class="volume icono-volumeMedium"></div>
                    </div>
                    <div class="volume-slider">
                        <div class="volume-percentage"></div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="titres-list">
            @for($i=0; $i<count($titres); $i++)
                @if ($album->id == $titres[$i]->album_id)
                    <li class="track">{{$titres[$i]['name']}}</li>
                @endif
            @endfor
        </ul>
    </div>
{{-- <figure>
    <audio class="player" controls
        src="../storage/albums/titres/{{ $album->id }}/{{$titres[0]['name']}}.mp3" type="audio/mp3">
    </audio>
</figure> --}}
@endsection
