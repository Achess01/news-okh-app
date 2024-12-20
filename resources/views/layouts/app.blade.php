<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <x-rich-text::styles theme="richtextlaravel" data-turbo-track="false" />
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm position-static">
        <div class="container">
            <a class="navbar-brand text-white" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-block d-md-none">
                    @include('components.sidebar')
                </div>
            </div>
        </div>
    </nav>
    <div class="row py-4">
        <div class="col-auto d-none d-md-block">
            @include('components.sidebar')
        </div>
        <main class="col">
            @yield('content')
        </main>
    </div>

</div>
</body>
</html>
