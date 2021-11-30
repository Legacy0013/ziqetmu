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
<body class="auth register">
    <header>
        <h1>créer un compte</h1>
    </header>

    <main>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                placeholder="votre email" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password"
                                placeholder="votre mot de passe" />
            </div>

              <!-- Suggestions -->
              <div class="mt-4 flex-row">
                <x-label for="suggestions" :value="__('m\'envoyer des suggestions')" />
                <x-input id="suggestions" class="block mt-1 w-full"
                                type="checkbox"
                                name="suggestions" />
            </div>
                <!-- CGV -->
                <div class="mt-4 flex-row">
                <x-label for="cgv" :value="__('j\'accepte les CGV')" />
                <x-input id="cgv" class="block mt-1 w-full"
                                type="checkbox"
                                name="cgv" />
            </div>

            <p>Nous pouvons utiliser votre e-mail et vos appareils pour vous envoyer des actualités et des conseils sur les produits et services Ziq&Mu.</p>

            <div class="flex items-center justify-end mt-4">
                <x-button class="btn">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
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
