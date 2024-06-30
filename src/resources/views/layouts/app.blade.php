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
            @if (Auth::check())
            <p class="header__right-heading">
                <a class="header__item-link" href="/">ホーム</a>
            
            
                <a class="header__item-link" href="/">日付一覧</a>

            
              <form class="form" action="/logout" method="post">
                @csrf
                <a class="header__item-link" href="/">ログアウト</a>
              </form>
            </p>
            @endif
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer__item">
            <small class="footer__text">
                Atte,inc.
            </small>
        </div>
    </footer>
  
</body>
</html>