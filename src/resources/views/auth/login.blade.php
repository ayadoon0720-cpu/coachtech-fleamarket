<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
    
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/commons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
   <header class="header">
     <div class="header-inner">
       <a href="/">
          <img src="{{ asset('storage/items/COACHTECH-header.png') }}" alt="COACHTECH" class="logo">
       </a>
     </div>
    </header>

    <div class="auth-container">
      <h2>ログイン</h2>

      <form method="POST" action="/login">
        @csrf

        <label>メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>パスワード</label>
        <input type="password" name="password">
        @error('password')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit" class="register-btn">ログインする</button>
       </form>

       <a href="/register" class="login-link">
        会員登録はこちら
       </a>
    </div>
</body>

</html>