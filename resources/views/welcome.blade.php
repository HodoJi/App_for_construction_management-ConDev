<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" value="{{ csrf_token() /* Laravel token - Do not remove! */ }}">

        <link rel="stylesheet" href="{{ asset('css/shown.css') }}" type="text/css">

@if (isset($_COOKIE['UserThemeUKFWebKurier']))
        <link id="themeLink" class="dark" rel="stylesheet" href="{{ asset('css/dark_mode.css') }}" type="text/css">
@else
        <link id="themeLink" class="light" rel="stylesheet" href="{{ asset('css/light_mode.css') }}" type="text/css">
@endif

        <title>Aplikácia na manažment stavieb a ich materiálu</title>
    </head>
    <body class="d-flex flex-column h-100">

    @if (Auth::check())
        @php
            $user_auth_data = [
                'isLoggedin' => true,
                'user' =>  Auth::user()
            ];
        @endphp
    @else
        @php
            $user_auth_data = [
                'isLoggedin' => false
            ];
        @endphp
    @endif

    <script>
        window.Laravel = JSON.parse(atob('{{ base64_encode(json_encode($user_auth_data)) }}'));
    </script>

        <div id="app"></div>
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    </body>
</html>
