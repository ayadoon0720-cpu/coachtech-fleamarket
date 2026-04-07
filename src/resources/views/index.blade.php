@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="top-container">

    <!-- タブ -->
    <div class="tab-area">
        <a href="/?keyword={{ request('keyword') }}" class="tab {{ request()->query('tab') === null ? 'active' : '' }}">おすすめ</a>

        @auth
            <a href="/?tab=mylist&keyword={{ request('keyword') }}" class="tab {{ request()->query('tab') === 'mylist' ? 'active' : '' }}">マイリスト</a>
        @endauth
    </div>

    <!-- 商品一覧 -->
    <div class="item-grid">

        @foreach($items as $item)
            <div class="item-card">
                <div class="item-image">
                    <a href="/item/{{ $item->id }}" class="item-card">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                    </a>
                </div>
                <p>{{ $item->name }}
                    @if($item->is_sold)
                    <span class="sold-badge">sold</span>
                    @endif
                </p>
            </div>
        @endforeach
    </div>

</div>
@endsection