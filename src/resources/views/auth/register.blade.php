<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
    
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/commons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
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
    <h2>会員登録</h2>

      <form method="POST" action="/register">
        @csrf

        <label>ユーザー名</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <p class="error">{{ $message }}</p> @enderror

        <label>メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <label>パスワード</label>
        <input type="password" name="password">
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <label>確認用パスワード</label>
        <input type="password" name="password_confirmation">

        <button type="submit" class="register-btn">登録する</button>
      </form>

      <a href="/login" class="login-link">ログインはこちら</a>
   </div>
</body>

</html>