<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/commons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body>

<header class="header">
    <div class="header-inner">

        <!-- ロゴ -->
        <div class="logo">
            <a href="/">
                <img src="{{ asset('storage/items/COACHTECH-header.png') }}" alt="COACHTECH">
            </a>
        </div>

        <!-- 検索フォーム -->
        <form class="search-box" action="/" method="GET">
            <input type="text" name="keyword" placeholder="なにをお探しですか？" value="{{ request('keyword') }}">
            @if(request('tab'))
            <input type="hidden" name="tab" value="{{ request('tab') }}">
            @endif
        </form>

        <!-- ナビゲーション -->
        <nav class="nav">
            @auth
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>

           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
           @csrf
           </form>
            @endauth

            @guest
                <a href="/login">ログイン</a>
            @endguest

                <a href="/mypage">マイページ</a>
                <a href="{{ route('items.create') }}" class="sell-btn">出品</a>
        </nav>

    </div>
</header>

<main>
    @yield('content')
</main>

</body>
</html>