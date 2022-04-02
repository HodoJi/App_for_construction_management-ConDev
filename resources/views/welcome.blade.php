<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" value="{{ csrf_token() /* Laravel token - Do not remove! */ }}">

        <link rel="stylesheet" href="{{ asset('css/shown.css') }}" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css">

@if (isset($_COOKIE['UserThemeTP2Management']))
        <link id="themeLink" class="dark" rel="stylesheet" href="{{ asset('css/dark_mode.css') }}" type="text/css">
@else
        <link id="themeLink" class="light" rel="stylesheet" href="{{ asset('css/light_mode.css') }}" type="text/css">
@endif

        <title>Aplikácia na manažment stavieb a ich materiálu</title>
    </head>
    <body class="h-100">

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
