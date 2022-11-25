<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('APP_NAME')}}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link
        rel="stylesheet"
        href="https://unpkg.com/@trevoreyre/autocomplete-js/dist/style.css"
    />
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="contenu">
    <header>
        @if (\Route::current()->getName() == 'home')
            <h1>
                <a href="{{ route('home') }}">
                    <img src="/img/logo.svg" alt="logo du site">
                </a>
            </h1>
        @else
            <a href="{{ url()->previous() }}">
                <img src="../img/prev-page.svg" alt="page précédente">
            </a>
        @endif
       <nav>
           <img src="../img/search.svg" id="searchLogo" alt="recherche">

           <div id="autocomplete" class="autocomplete">
               <input class="autocomplete-input"
                      placeholder="Rechercher"
                      aria-label="Rechercher"
               >
               <div class="autocomplete-result-list">
                    <ul class="albums"></ul>
                    <ul class="artists"></ul>
                    <ul class="noResult">
                        <li>Désolé, il n'y a aucun résultat pour cette recherche</li>
                    </ul>
               </div>
               <img src="../img/close-black.svg" id="closeBtn" alt="fermer">
           </div>

           <img src="../img/settings.svg" id="settings" alt="paramètres">

           <div class="settingsMenu">
               <ul>
                   <li><a href="{{ route('favoris') }}">Favoris</a></li>
                   <li><a href="{{ route('contact') }}">Contact</a></li>
                   <li><a href="{{ route('logout') }}">Déconnexion</a></li>
               </ul>
           </div>
       </nav>
    </header>

    <main id="swup" class="transition-fade">
        @yield('content')
    </main>

    @include('pages.player')

    <div class="partial-player">
        @include('pages.partial-player')
    </div>

    <div class="audio-container"></div>
    <footer>

    </footer>

    <script src="/js/app.js" defer></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script src="https://unpkg.com/@trevoreyre/autocomplete-js"></script>
    <script>
        var route = "{{ url('autocomplete-search') }}";
        let s_input = $("#autocomplete input")[0];

        $(s_input).on('keyup', e => {
            let url = route + `?q=${e.target.value}`
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    display_results(data, e.target.value);
                })
        })

        let display_results = (data, iq) => {
            let s_input = $("#autocomplete input")[0];
            let {artists, albums} = data;
            let [artist_div, album_div, noResult_div] = [$('.autocomplete-result-list .artists'),$('.autocomplete-result-list .albums'),$('.noResult')];
            album_div.hide();
            artist_div.hide();
            noResult_div.hide();
            artist_div.html('');
            if(artists?.length > 0){
                noResult_div.hide();
                artist_div.show();
                artist_div.append(`<li><h2 class="result-title">Artiste(s)</h2></li><li><hr></li>`);
                artists.map((item, key) => {
                    let name = colorize_query(item.name, iq)
                    let ar_url = 'artiste/'+item.id
                    artist_div.append(`<li><a href="/${ar_url}" class="result-item">${name}</a></li>`)
                })
            }
            album_div.html('');
            if(albums?.length > 0){
                noResult_div.hide();
                album_div.show();
                album_div.append(`<li><h2 class="result-title">Album(s)</h2></li><li><hr></li>`);
                albums.map((item, key) => {
                    let name = colorize_query(item.name, iq)
                    let al_url = 'album/'+item.id
                    album_div.append(`<li><a href="/${al_url}" class="result-item">${name}</a></li>`)
                })
            }
            if(albums?.length === 0 && artists?.length === 0){
                album_div.hide();
                artist_div.hide();
                noResult_div.show();
            }
            if(s_input.value.length === 0){
                album_div.hide();
                artist_div.hide();
                noResult_div.hide();
            }
            add_event_listeners();

        }

        let add_event_listeners = () => {
            $('.autocomplete-result-list .result-item').on('click', reset_search);
        }

        let colorize_query = (item, string) => {
            const regex = new RegExp(`(${string})`, "gmi");

            const subst = `<span class="colorize">$1</span>`;
            // The substituted value will be contained in the result variable
            return item.replace(regex, subst);
        }

        let reset_search = () => {
            let container= $("#autocomplete");
            container.hide();
            let s_input = $("#autocomplete input")[0];
            $(s_input).val('');
            let divs = [$('.autocomplete-result-list .artists'),$('.autocomplete-result-list .albums'),$('.autocomplete-result-list .noResult')];
            divs.map((item, key) => {
                $(item).hide();
            })
        }
    </script>
</body>
</html>
