<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{env('APP_DOMAIN')}}</title>
        <link rel="shortcut icon" href="{{asset('logo-32.png')}}" />
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('admin/css/app.css')}}">
    </head>
    <body class="antialiased">
    <div id="app"></div>
    </body>
    <script src="{{asset('admin/js/app.js')}}"></script>
</html>
