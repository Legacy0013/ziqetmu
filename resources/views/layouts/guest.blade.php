<!DOCTYPE html>
<html lang="en">
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
<body class="auth splash">
    <header>
        <img src="/img/logo.svg" alt="logo du site">
        <h1>écoutez votre musique favorite en un seul clic</h1>
    </header>
    <main>
        <div class="register">
            <h2>
                Profitez gratuitement <br> de toute votre musique
            </h2>
            <a href="{{ route('register') }}" class="btn">s'inscrire</a>
        </div>
        <div class="login">
            <h2>
                Vous avez déjà un compte ?
            </h2>
            <a href="{{ route('login') }}" class="btn">se connecter</a>
        </div>
        <p>Explorez tout un monde de musique sans publicité, hors connexion et même avec l’écran verrouillé. Disponible sur mobile et ordinateur. Ziq&mu propose des albums officiels, des playlists, des singles et plus encore.</p>
    </main>
    <footer>
        <a href="">Mentions légales</a>
        <a href="">CGV</a>
        <a href="">Contact</a>
        <ul>
            <a href="">
                <li><img src="/img/facebook.svg" alt="logo facebook"></li>
            </a>
            <a href="">
                <li><img src="/img/instagram.svg" alt="logo instagram"></li>
            </a>
            <a href="">
                <li><img src="/img/pinterest.svg" alt="logo pinterest"></li>
            </a>
        </ul>
    </footer>
    <script src="/js/app.js" defer></script>
</body>
</html>
