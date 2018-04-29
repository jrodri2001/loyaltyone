<!DOCTYPE html>
<html>
<head>
    <title>LoyaltyOne - @yield('title')</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    @yield('content')


<script src="/js/app.js"></script>
@yield('scripts')
</body>
</html>