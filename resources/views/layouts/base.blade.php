<!DOCTYPE html>
<html>
<head>
    <title>LoyaltyOne - @yield('title')</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.0/handlebars.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    @yield('content')


<script src="/js/app.js"></script>
@yield('scripts')
</body>
</html>