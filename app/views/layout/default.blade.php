<!DOCTYPE html>

<html lang="en-US">
    <head>
        <meta charset="UTF-8" />
        <title>@yield('title')</title>
        <link rel="icon" type="image/png" href="/img/favicon.png?v=3" />
        <link rel="stylesheet" href="/styles.css" />
        @yield('extras')
    </head>
    <body>
        @include('layout.nav')
        <section id="content">
            @yield('content')
        </section>
    </body>
</html>