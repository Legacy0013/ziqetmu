@extends('layout.layout')

@section('content')
<div class="container-artiste">
    <div class="top">
        <img src="../storage{{ $artiste->picture }}" alt="">
        <h2>{{ $artiste->name }}</h2>
        <div class="likeArtiste">
            {{ $nbrLikeArtiste }}
        </div>
        <form action="{{ route('likeArtiste', $artiste->id) }}" method="post" id="like">
            @csrf
            @if ($liked == true)
                <div class="wrap liked">
                    <input type="hidden" name="artiste_id" value="{{ $artiste->id }}">
                    <input type="submit" id="likeArtiste" value="ajouter">
                </div>
             @else
                <div class="wrap">
                    <input type="hidden" name="artiste_id" value="{{ $artiste->id }}">
                    <input type="submit" id="likeArtiste" value="ajouter">
                </div>
            @endif
        </form>
    </div>
    <div class="bottom">
        <h2>discographie</h2>
        <div class="wrap-cards">
            @foreach ($albums as $album)
                <a href="{{ route('album', $album->id) }}">
                    <div class="card">
                        <img src="../storage{{ $album->picture }}" alt="">
                        <div class="artiste_name">{{ $artiste->name}}</div>
                        <div class="album_name">{{ $album->name}}</div>
                        <div class="play"></div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
