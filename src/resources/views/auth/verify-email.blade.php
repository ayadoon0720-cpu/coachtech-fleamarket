<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
    
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/commons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
</head>

<body>
   <header class="header">
    <div class="header-inner">
      <a href="/">
        <img src="{{ asset('storage/items/COACHTECH-header.png') }}" alt="COACHTECH" class="logo">
      </a>
    </div>
   </header>
<div class="verify-wrapper">
    <div class="verify-card">
    <p>
        登録していただいたメールアドレスに認証メールを送付しました。<br>
        メール認証を完了してください。
    </p>

    <a href="http://localhost:8025" target="_blank" class="btn">認証はこちらから</a>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="resend">認証メールを再送する</button>
    </form>
    </div>
</div>
</body>

</html>