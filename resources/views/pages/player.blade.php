@if ($lastRecent)
    <div class="container-player">
        <div class="hide">
        <img src="../img/arrow-down.svg" alt="icone fermer">
        </div>
        <input type="hidden" name="album_id" id="album_id" value="{{ $lastAlbum->id }}">
        <h2>{{ $lastAlbum->name }}</h2>
        <img class="cover" src="../storage/albums/covers/{{ $lastAlbum->id }}/cover.jpg" alt="">
        <form action="{{ route('likePlayer', $lastAlbum->id) }}" method="post" id="like" class="likeOfTheAlbum">
            @csrf
            @if ($liked == true)
                <div class="wrap liked">
                    <input type="hidden" name="album_id" value="{{ $lastAlbum->id }}">
                    <input type="submit" class="likeAlbum" value="retirer">
                </div>
            @else
                <div class="wrap">
                    <input type="hidden" name="album_id" value="{{ $lastAlbum->id }}">
                    <input type="submit" class="likeAlbum" value="ajouter">
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
                    <div class="titres_count">
                        <p>{{ count($lastAlbum->titre) }} titres</p>
                    </div>
                    <div class="separator"></div>
                    <div class="duration">{{ $lastAlbum->duration }} min</div>
                </div>
            </div>
            <div class="currentSong">
                <span class="album-cover">
                    <img src="../storage/{{ $lastAlbum->picture }}" alt="">
                </span>
                <span class="current-track">
                    <span class="current-song"></span>
                    <div class="wrap-name">
                        <div class="textSlide">
                            <div class="album_name">{{ $lastAlbum->name }}</div>
                            <div class="separator"></div>
                            <div class="artiste_name">{{ $lastAlbum->artiste->name }}</div>
                        </div>
                    </div>
                </span>
                <span class="like">
                    <form action="{{ route('likePlayer', $lastAlbum->id) }}" method="post" id="likePlaylist">
                        @csrf
                        @if ($liked == true)
                            <div class="wrapPlaylist liked">
                                <input type="hidden" name="album_id" value="{{ $lastAlbum->id }}">
                                <input type="submit" class="likeAlbum" value="">
                            </div>
                        @else
                            <div class="wrapPlaylist">
                                <input type="hidden" name="album_id" value="{{ $lastAlbum->id }}">
                                <input type="submit" class="likeAlbum" value="">
                            </div>
                        @endif
                    </form>
                </span>
            </div>
            <div class="albumTracks">
                <input type="hidden" name="album_id" id="album_id" value="{{ $lastAlbum->id }}">
                @for($i=0; $i<count($titres); $i++)
                    @if($lastAlbum->id == $titres[$i]->album_id)
                        <div class="titre">
                            <div class="track-infos">
                                <span class="number">
                                {{ str_pad($titres[$i]['order'], 2, '0', STR_PAD_LEFT) }}
                                 </span>
                                <span class="track">{{$titres[$i]['name']}}</span>
                            </div>
                            <span class="like">
                                <form action="{{ route('likePlayer', $lastAlbum->id) }}" method="post" class="likeTitre">
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
@endif

