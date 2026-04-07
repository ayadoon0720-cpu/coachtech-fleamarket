@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="profile">

    <div class="profile-header">

    <div class="profile-user">
        <img src="{{ $user->profile_image ? asset('images/' . $user->profile_image) . '?' . time() : '' }}" class="profile-img">

        <h2>{{ $user->name }}</h2>
    </div>

        <a href="{{ route('profile.edit') }}" class="edit-btn">
            プロフィールを編集
        </a>

    </div>

    <div class="tab-line">
    <div class="tab">
        <a href="/mypage?page=sell"
        class="{{ $page == 'sell' ? 'active' : '' }}">
        出品した商品
        </a>

        <a href="/mypage?page=buy"
        class="{{ $page == 'buy' ? 'active' : '' }}">
        購入した商品
        </a>
    </div>
    </div>


    <div class="item-list">

        @foreach ($items as $item)

        <div class="item">
            <img src="{{ asset('storage/' . $item->image) }}">
            <p>{{ $item->name }}</p>
        </div>

        @endforeach

    </div>

</div>
@endsection