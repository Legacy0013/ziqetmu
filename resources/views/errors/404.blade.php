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
<body class="auth register login page-error">
    <header>
        <h1>Erreur</h1>
    </header>

    <main class="error">
        <h1>404 | Page non trouvé</h1>
        <div class="message">
            <a href="{{ route('home') }}" class="btn">Revenir à l'accueil</a>
        </div>
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
