<!DOCTYPE html>

<html lang="en-US">
    <head>
        <meta charset="UTF-8" />
        <title>@yield('title')</title>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic|Roboto+Condensed:300,400,700|Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/styles.css" />
    </head>
    <body>
        @include('layout.nav')
        <section id="content" class="card-wrapper">
            @yield('content')
        </section>
    </body>
</html>