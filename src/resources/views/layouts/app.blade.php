<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body>
    <header>
        <div class="header__left">
            <h1 class="header__heading">Atte</h1>
            @yield('link')
        </div>
        <div class="header__right">
            <h1 class="header__right-heading">
                <a class="header__item-link" href="/">ホーム</a>
            </h1>
            <h1 class="header__right-heading">
                <a class="header__item-link" href="/">日付一覧</a>
            </h1>
            <h1 class="header__right-heading">
                <a class="header__item-link" href="/">ログアウト</a>
            </h1>
        </div>
    </header>

    <main>
        @yield('content')
    </main>


    
</body>
</html>