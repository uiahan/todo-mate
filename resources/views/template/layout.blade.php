<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TodoMate | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://naramizaru.github.io/fa-pro/css/all.min.css">
    @stack('css')
</head>
<body>
    @yield('content')
</body>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
@stack('js')
</html>
