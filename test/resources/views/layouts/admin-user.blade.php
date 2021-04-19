<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name', 'Laravel')}}</title>
    <!-- <link rel="stylesheet" href="./node_modules/normalize.css/normalize.css"> -->

    <!-- scripts -->
    <!-- @yield('scripts') fattibile per includere altri js solo nei file che mi servono -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/scripts-dev-jQuery.js') }}"></script>
    <script src="{{ asset('js/scripts-api.js') }}"></script>

    <!-- styles  -->
    <!-- in webpack.mix.js copiati da node_modules -->
    <!-- la directory assets la prende dal config app.php -->
    <!-- <link href="{{ asset('css/nm.bootstrap.css') }}" rel="stylesheet"> importato in app.css -->
    <link href="{{ asset('css/nm.all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontaw.all.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/utils.css') }}" rel="stylesheet">
    <!-- diventerà come sopra -->
    <!-- <link rel="stylesheet" href="./public/css/style.css"> -->
</head>
<body>
    <!-- INCLUDO DA PARTIALS -->
    @include('partials.admin-header')
    <main id="main">
        @yield('content')
    </main>
</body>
</html>
