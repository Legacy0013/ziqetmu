@if ($lastRecent)
    <div class="audio-player">
        <div class="top">
            <div class="left">
                <img src="../storage{{ $lastAlbum->picture }}" alt="">
            </div>
            <div class="middle">
                <div class="titre_name_container">
                    <span class="titre_name">{{ $lastAlbum->titre[0]->name }}</span>
                </div>
                <div class="wrap-name">
                    <div class="textSlide2">
                        <div class="element">
                            <div class="album-name">{{ $lastAlbum->name }}</div>
                            <div class="separator"></div>
                            <div class="artiste_name">{{ $lastAlbum->artiste->name }}</div>
                        </div>
                        <div class="element">
                            <div class="album-name">{{ $lastAlbum->name }}</div>
                            <div class="separator"></div>
                            <div class="artiste_name">{{ $lastAlbum->artiste->name }}</div>
                        </div>
                        <div class="element">
                            <div class="album-name">{{ $lastAlbum->name }}</div>
                            <div class="separator"></div>
                            <div class="artiste_name">{{ $lastAlbum->artiste->name }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="controls">
                    <div class="loop"></div>
                    <div class="prev"></div>
                    <div class="play-container">
                        <div class="toggle-play play"></div>
                    </div>
                    <div class="next"></div>
                    <div class="shuffle"></div>
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="timeline">
                <div class="progress"></div>
            </div>
        </div>

        <div class="albumTracks">
            @for($i=0; $i<count($titres); $i++)
                @if($lastAlbum->id == $titres[$i]->album_id)
                    <div class="titre">
                        <span class="number">
                            {{ str_pad($titres[$i]->order, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <span class="track">{{$titres[$i]->name}}</span>
                        <span class="like">
                            <form action="{{ route('likePlayer', $lastAlbum->id) }}" method="post" class="likeTitre">
                                @csrf
                                @if (in_array($titres[$i]->id, $likedTitres->pluck('titre_id')->all()))
                                    <div class="wrapTitre liked">
                                        <input type="hidden" name="titre_id" value="{{ $titres[$i]->id }}">
                                        <input type="submit" value="">
                                    </div>
                                @else
                                    <div class="wrapTitre">
                                        <input type="hidden" name="titre_id" value="{{ $titres[$i]->id }}">
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
@endif
