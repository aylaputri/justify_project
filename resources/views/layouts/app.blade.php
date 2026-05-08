<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/global.css') }}">

    @stack('style')

    <title>@yield('title', 'Savior World') </title>

</head>
<body>
    @yield('content')

    <script src="{{ asset('js/page/navbar.js') }}"></script>

    @stack('scripts')
</body>
</html>