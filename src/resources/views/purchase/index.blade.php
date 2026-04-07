@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<form method="POST" action="{{ url('/purchase/' . $item->id) }}">
    @csrf
    <input type="hidden" name="address_id" value="{{ $address->id ?? '' }}">
<div class="purchase">
  {{-- 左側 --}}
  <div class="left">
    <div class="item-info">
      <img src="{{ asset('storage/' . $item->image) }}" class="item-img">
        <div class="item-text">
          <h2>{{ $item->name }}</h2>
          <p class="price">¥{{ number_format($item->price) }}</p>
          @if($item->is_sold)
          <span class="sold-badge">sold</span>
          @endif
        </div>
    </div>
    {{-- 支払い方法 --}}
    <div class="section">
      <label>支払い方法</label>
      <select name="payment_method">
        <option value="">選択してください</option>
        <option value="konbini">コンビニ支払い</option>
        <option value="card">カード支払い</option>
      </select>
    </div>
    {{-- 配送先 --}}
    <div class="section">
      <div class="section-header">
        <label>配送先</label>
        <a href="/purchase/address/{{ $item->id }}">変更する</a>
      </div>
      <p class="postal_code">〒{{ $address->postal_code ?? '未登録' }}</p>
      <p class="address">{{ $address->address ?? '未登録' }}</p>
    </div>
  </div>

  {{-- 右側 --}}
  <div class="right">
    <div class="right-box">
      <div class="row">
        <span>商品代金</span>
        <span>¥{{ number_format($item->price) }}</span>
      </div>
      <div class="row">
        <span>支払い方法</span>
        <span id="payment-text">未選択</span>
      </div>
    </div>
    
      
      <button type="submit" class="purchase-btn">購入する</button>
  </div>
</div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const select = document.querySelector('select[name="payment_method"]');
    const text = document.getElementById('payment-text');
    

    select.addEventListener('change', function() {
        let value = '';

        if (this.value === 'konbini') value = 'コンビニ支払い';
        if (this.value === 'card') value = 'カード支払い';

        text.textContent = value;
       
    });

});
</script>
@endsection
