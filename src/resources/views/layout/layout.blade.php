<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('ttl')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reg_login_common.css') }}">
    {{-- webフォント --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" クロスオリジン> 
    <link href="https: //fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    @yield('css')
</head>
<body>

    <header class="header">
        <div class="header_inner">
            <p class="header_spacer"></p>
            <h1>FashionablyLate</h1>
            @yield('header_btn')
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>
    
</body>
</html>