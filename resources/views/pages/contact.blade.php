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
    <main class="container-page">
        <h2>Contact</h2>

        <form action="{{ url('contact') }}" method="POST">
            @csrf
            <div class="ligne">
                <label class="block font-medium text-sm text-gray-700" for="nom">Entrez votre nom : </label>
                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" type="text" name="nom" id="nom" value="{{ old('nom') }}">
                @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="ligne">
                <label class="block font-medium text-sm text-gray-700" for="email">Entrez votre email : </label>
                <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" type="email" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="ligne">
                <label class="block font-medium text-sm text-gray-700" for="message">Entrez votre message : </label>
                <textarea class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" name="message" id="message">{{ old('message') }}</textarea>
                @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-column">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3 btn">
                    Envoyer le message
                </button>
            </div>
        </form>
    </main>

    <footer>
        <div class="container">
            <a href="{{ route('page', ['name' => 'mentionsLegales'] ) }}">Mentions légales</a>
            <a href="{{ route('page', ['name' => 'cgv'] ) }}">CGV</a>
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
