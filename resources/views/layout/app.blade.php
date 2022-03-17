<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title> @yield('title') </title>
</head>

<body>
    @yield('content')
    <div class="d-none d-lg-flex position-absolute top-0 back-img"><img src="{{ asset('img/Vector 2.png') }}" alt="" width="1354" height="648"></div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>