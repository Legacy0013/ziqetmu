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
<body class="auth register login">
    <header class="rwd">
        <h1>
            <a href="{{ route('home') }}">
                <img src="/img/logo.svg" alt="logo du site">
            </a>
        </h1>
    </header>
    <main class="container container-page">
        <h2>Conditions Générales d'Utilisation</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat amet explicabo fugit, iste dolor nesciunt dolores et quam mollitia obcaecati eligendi qui laborum totam eaque error eveniet possimus voluptate aspernatur?</p>
        @for ($i = 1; $i < 10; $i++)
            <h3>Partie <span>{{$i}}</span></h3>
            @for ($j = 1; $j < 3; $j++)
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat amet explicabo fugit, iste dolor nesciunt dolores et quam mollitia obcaecati eligendi qui laborum totam eaque error eveniet possimus voluptate aspernatur?</p>
            @endfor
        @endfor
    </main>

    <footer>
        <div class="container">
            <a href="{{ route('page', ['name' => 'mentionsLegales'] ) }}">Mentions légales</a>
            <a href="{{ route('page', ['name' => 'cgv'] ) }}">CGV</a>
            <a href="{{ route('contact') }}">Contact</a>
            <ul>
                <li><a href="https://www.facebook.com" target="_blank"><img src="/img/facebook.svg" alt="logo facebook"></a></li>
                <li><a href="https://www.instagram.com/" target="_blank"><img src="/img/instagram.svg" alt="logo instagram"></a></li>
                <li><a href="https://fr.pinterest.com/" target="_blank"><img src="/img/pinterest.svg" alt="logo pinterest"></a></li>
            </ul>
        </div>
    </footer>
    <script src="/js/app.js" defer></script>
</body>
</html>
