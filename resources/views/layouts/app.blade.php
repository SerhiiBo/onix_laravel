<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <!-- Scripts -->
</head>
    <body>
        <!-- Page Heading -->
        <header>
            @include('posts.inc.header')
        </header>

        @include('posts.inc.messages')

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </body>
</html>
