@extends('layout.layout')

@section('content')
<div class="container-home">
    <main>
        <div class="recents">
            <h2>écouté récemment</h2>
            @if (count($recents) > 0)
            <div class="wrap-cards">
                @foreach ($albums as $album)
                    @foreach ($artistes as $artiste)
                        @if ($album->artiste_id == $artiste->id)
                            <a href="{{ route('player', $album->id) }}">
                                <div class="card">
                                    <img src="storage{{ $album->picture }}" alt="">
                                    <div class="artiste_name">{{ $artiste->name}}</div>
                                    <div class="album_name">{{ $album->name}}</div>
                                    <div class="play"></div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                @endforeach
            </div>
            @endif

        </div>
        <div class="genres">
            <h2>
                <a href="{{ route('genres') }}">
                    Genres <span>></span>
                </a>
            </h2>
            <div class="wrap-cards">
                <?php $length = count($genres); ?>
                @for ($i = 0; $i < $length; $i+=2)
                    <div class="two-cards">
                        <a href="{{ route('genre', $genres[$i]->id) }}">
                            <div class="card">
                                <div class="name">{{ $genres[$i]->name }}</div>
                            </div>
                        </a>
                        @if (isset($genres[$i+1]))
                        <a href="{{ route('genre', $genres[$i+1]->id) }}">
                            <div class="card">
                                <div class="name">{{ $genres[$i+1]->name }}</div>
                            </div>
                        </a>
                        @endif
                    </div>
                @endfor
            </div>
        </div>
        <div class="artistes">
            <h2>Artistes</h2>
            <div class="wrap-cards">
                @foreach ($artistes as $artiste)
                    <a href="{{ route('artiste', $artiste->id) }}">
                        <div class="card">
                            <img src="storage{{ $artiste->picture }}" alt="">
                            <div class="artiste_name">{{ $artiste->name }}</div>
                            {{-- <div class="album_name">{{ $album->like }}</div> --}}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </main>

</div>
@endsection
