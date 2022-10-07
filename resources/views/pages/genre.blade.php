@extends('layout.layout')

@section('content')
    <div class="container-genre">
        <h2>{{ $genre->name }}</h2>
        <h3>Albums {{ ucfirst($genre->name) }} Essentiels</h3>

        <div class="top">
            <div class="wrap-cards">
                @foreach ($albums as $album)
                <a href="{{ route('album', $album->id) }}">
                    <div class="card">
                        <img src="../storage/{{ $album->picture }}" alt="">
                        <h2 class="album_name">{{ ucfirst($album->name) }}</h2>
                        <h2 class="artiste_name">par {{ $album->artiste->name }}</h2>
                        <span class="date">
                            Sorti en {{ $album->date }}
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <div class="bottom">
            <h3>Artistes {{ ucfirst($genre->name) }} Essentiels</h3>
            <div class="wrap-cards">
                @foreach (array_unique($artistes) as $artiste)

                    <a href="{{ route('artiste', $artiste->id) }}">
                        <div class="card">
                            <img src="../storage/{{ $artiste->picture }}" alt="">
                            <div class="artiste_name">{{ $artiste->name }}</div>
                            {{-- <div class="album_name">{{ $album->like }}</div> --}}
                        </div>
                    </a>

                @endforeach
            </div>
        </div>
    </div>
@endsection
