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
            <a href="{{ route('home') }}">
                <img src="../img/search.svg" alt="page précédente">
            </a>
            <a href="{{ route('home') }}">
                <img src="../img/settings.svg" alt="page précédente">
            </a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
</body>
</html>
