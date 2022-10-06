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
    <header>
        <h1>se connecter</h1>
    </header>

    <main>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
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

            {{-- Forgot password --}}
            <div class="flex-column">
                @if (Route::has('password.request'))
                    <a class="" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3 btn">
                    {{ __('Log in') }}
                </x-button>
            </div>

             {{-- register--}}
             <div class="flex-column">
                <x-label for="password" :value="__('Vous n\'avez pas de compte ?')" />

                <a href="{{ route('register') }}" class="btn">s'inscrire</a>
            </div>
        </form>
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