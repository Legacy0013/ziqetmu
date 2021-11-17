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
                <form action="" method="post">
                    @csrf
                    <div class="wrap">
                        <input type="submit" value="ajouter">
                    </div>
                </form>
                <form action="" method="post">
                    @csrf
                    <div class="wrap">
                        <input type="submit" value="écouter">
                    </div>
                </form>
            </div>
        </div>
        <div class="bottom">
            @foreach ($titres as $titre)
                <div class="titre">
                    <span class="number">
                        {{ str_pad($titre->order, 2, '0', STR_PAD_LEFT) }}
                    </span>
                    <span class="titre_name">
                        {{ $titre->name }}
                    </span>
                    <span class="like">
                        {{-- @if (si le titre est liké ou non)

                        @endif --}}
                        <img src="../img/favori-active.svg" alt="">
                    </span>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection
