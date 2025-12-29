<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__left"></div>
            <div class="header__center">
                <a href="/" class="header__logo">FashionablyLate</a>
            </div>
            <div class="header__right">
                @yield('header-nav')
            </div>
        </div>
    </header>

    <main>
        <div class="page-title">
            <h2 class="page-title__header">@yield('title')</h2>
        </div>
        @yield('content')
    </main>
</body>

</html>