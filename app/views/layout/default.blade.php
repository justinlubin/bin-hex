<!DOCTYPE html>

<html lang="en-US">
    <head>
        <meta charset="UTF-8" />
        <title>@yield('title')</title>
        <link href='http://fonts.googleapis.com/css?family=Lobster+Two:700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,300italic,400,400italic,700,700italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/styles.css" />
    </head>
    <body>
        @include('layout.nav')
        <section id="content">
            @yield('content')
        </section>
    </body>
</html>