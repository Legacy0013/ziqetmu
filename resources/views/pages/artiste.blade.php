@extends('layout.layout')

@section('content')
<div class="container-artiste">
    <div class="top">
        <img src="../storage{{ $artiste->picture }}" alt="">
        <h2>{{ $artiste->name }}</h2>
        <div class="like">
            871,189
        </div>
        <form action="{{ route('likePArtiste', $album->id) }}" method="post" id="like">
            @csrf
            <div class="wrap">
                <input type="submit" value="ajouter">
            </div>
        </form>
    </div>
    <div class="bottom">
        <h2>discographie</h2>
        <div class="wrap-cards">
            @foreach ($albums as $album)
                <a href="{{ route('album', $album->id) }}">
                    <div class="card">
                        <img src="../storage{{ $album->picture }}" alt="">
                        <div class="titre_name">{{ $artiste->name}}</div>
                        <div class="album_name">{{ $album->name}}</div>
                        <div class="play"></div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
