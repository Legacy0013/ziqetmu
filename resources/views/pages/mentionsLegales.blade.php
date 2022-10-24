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
        <h2>Mentions Légales</h2>
        <p>Conformément aux dispositions de la loi n° 2004-575 du 21 juin 2004 pour la confiance en l'économie numérique, il est précisé aux utilisateurs du Site l'identité des différents intervenants dans le cadre de sa réalisation et de son suivi.</p>

        <h3>Édition du site</h3>
        Le site est édité par un particulier à des fins d'exercice.

        <h3>Responsable de publication</h3>
        Monsieur Rémy, développeur.

        <h3>Hébergeur</h3>
        Le site est édité par un particulier à des fins d'exercice.

        <h3>Nous contacter</h3>
        <ul>
            <li>Par téléphone : <a href="tel+33102030405">01 02 03 04 05</a></li>
            <li>Par email : <a href="mailto:contact@ziqetmu.fr">contact@ziqetmu.fr</a></li>
        </ul>


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
