<!DOCTYPE html>

<html lang="en-US">
    <head>
        <meta charset="UTF-8" />
        <title>@yield('title')</title>
    </head>
    <body>
        @include('layout.nav')
        @yield('content')
    </body>
</html>