@extends('layout.layout')

@section('content')
<div class="container-home">
    <main>
        <div class="recents">
            <h2>écouté récemment</h2>
            @if (count($recents) > 0)
                <div class="wrap-cards">
                    @foreach ($albums as $album)
                        <div class="card">
                            <input type="hidden" name="album_id" value="{{ $album->id }}">
                            <input type="hidden" name="duration" value="{{ $album->duration }}">
                            <img src="storage{{ $album->picture }}" alt="">
                            <div class="artiste_name">{{ $album->artiste->name}}</div>
                            <div class="album_name">{{ $album->name}}</div>
                            <div class="play"></div>
                            <div class="albumTracks">
                                @for($i = 0; $i < count($album->titre); $i++)
                                <div class="titre">
                                    <span class="number">
                                        {{ str_pad($album->titre[$i]->order, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <span class="track">{{$album->titre[$i]->name}}</span>
                                    <span class="like">
                                        <form action="{{ route('likePlayer', $album->id) }}" method="post" class="likeTitre">
                                            @csrf
                                            @if (in_array($album->titre[$i]->id, $likedTitres->pluck('titre_id')->all()))
                                                <div class="wrapTitre liked">
                                                    <input type="hidden" name="titre_id" value="{{ $album->titre[$i]->id}}">
                                                    <input type="submit" value="">
                                                </div>
                                            @else
                                                <div class="wrapTitre">
                                                    <input type="hidden" name="titre_id" value="{{ $album->titre[$i]->id }}">
                                                    <input type="submit" value="">
                                                </div>
                                            @endif
                                        </form>
                                    </span>
                                </div>
                                @endfor
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h3>Vous n'avez encore rien écouté !</h3>
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
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </main>

</div>
@endsection
