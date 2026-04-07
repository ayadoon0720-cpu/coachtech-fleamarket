@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')

<div class="detail">

  <div class="left">
    <img src="{{ asset('storage/' . $item->image) }}" class="item-img">
  </div>

  <div class="right">
    <h2 class="name">{{ $item->name }}</h2>
    <p class="brand">{{ $item->brand }}</p>
    <p class="price">
       ¥{{ number_format($item->price) }} (税込)
    </p>
 @if($item->is_sold)
  <span class="sold-badge">sold</span>
@endif
  <div class="icons">
    <div class="icon-box">
      <form action="/item/{{ $item->id }}/like" method="POST">
       @csrf
       <button class="like-btn">
          @if($liked)
          <img src="{{ asset('storage/items/ハートロゴ_ピンク.png') }}">
          @else
          <img src="{{ asset('storage/items/ハートロゴ_デフォルト.png') }}">
          @endif
       </button>
      </form>
      <span>{{ $like_count }}</span>
    </div>

    <div class="icon-box">
       <img src="{{ asset('storage/items/ふきだしロゴ.png') }}" class="comment-logo">
       <span> {{ $comment_count }}</span>
    </div>

  </div>

  <a href="/purchase/{{ $item->id }}" class="buy-btn">購入手続きへ</a>

  <h3 class="description">商品説明</h3>
  <p>{{ $item->description }}</p>

  <h3 class="information">商品の情報</h3>
<div class="category-row">
  <p class="category">カテゴリー</p>
<div class="category-list">
  @foreach($item->categories as $cat)
  <span class="cat">{{ $cat->name }}</span>
  @endforeach
</div>
</div>
  <p class="condition">商品の状態
    <span class="condition-text">
    {{ $item->condition->name }}</span>
  </p>

  <h3 class="comment-title">コメント({{ $comment_count }})</h3>

  @foreach($item->comments as $comment)
      <div class="comment-header">
        <img src="{{ asset('storage/' . $comment->user->profile_image) }}" class="profile-img">
        <span class="user-name">{{ $comment->user->name }}</span>
      </div>
      <div class="comment-box">
      <p class="comment-content">{{ $comment->comment }}</p>
    </div>
  @endforeach

  @auth
  <form action="/item/{{ $item->id }}/comment" method="POST" class="comment-form">
    @csrf
    <p class="comment-message">商品へのコメント</p>
    <textarea name="comment"></textarea>

    @error('comment')
      <p class="error">{{ $message }}</p>
    @enderror

    <button type="submit">コメントを送信する
    </button>
  </form>
  @endauth
</div>
</div>
@endsection