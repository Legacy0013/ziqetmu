@if ($lastRecent)
    <div class="audio-container">
        <input type="hidden" name="album_id" id="album_id" value="{{ $lastAlbum->id }}">
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
                                <div class="album-name">{{ $lastAlbum->name }}</div>
                                <div class="separator"></div>
                                <div class="artiste_name">{{ $lastAlbum->artiste->name }}</div>
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
                    <div class="titres">
                        @foreach ($titres as $titre)
                            @if ($titre->album_id == $lastAlbum->id)
                                <span class="track">{{$titre->name}}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
    </div>

@endif
