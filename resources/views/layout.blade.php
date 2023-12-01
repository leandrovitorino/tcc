<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="robots" content="noindex, nofollow" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{$title}}</title>
        <link rel="stylesheet" href="/css/pagination.js.css">
        <link rel="stylesheet" href="/css/estilo.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    </head>
    <header>
        <div id="app">
            @include('base.components.header')
        </div>
    </header>
    <body>
        <div class="container">
            @yield('content')
        </div>
        <script src="{{ asset('/js/jquery.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="{{ asset('/js/jquery.mask.min.js') }}"></script>
        <script src="{{ asset('/js/leandro.js') }}"></script>
        <script src="{{ asset('/js/pagination.min.js') }}"></script>
    </body>
</html>
