<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title')
    </title>

    <!-- FONT -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">

    <!-- GLOBAL CSS -->
    <link
        rel="stylesheet"
        href="{{ asset('css/page/admin/global.css') }}">

    @stack('style')

</head>

<body>

    @yield('content')

    <!-- GLOBAL JS -->
    <script src="{{ asset('js/page/admin/global.js') }}"></script>

    @stack('scripts')

</body>

</html>