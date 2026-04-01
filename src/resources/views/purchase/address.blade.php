@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
<div class="container">
<h2>住所の変更</h2>

<form action="/purchase/address/{{ $item_id }}" method="POST">
    @csrf
        <label>郵便番号</label>
        <input type="text" name="postal_code" value="{{ old('postal_code', $address->postal_code ?? '') }}">
        @error('postal_code')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>住所</label>
        <input type="text" name="address" value="{{ old('address', $address->address ?? '') }}">
        @error('address')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>建物名</label>
        <input type="text" name="building" value="{{ old('building', $address->building ?? '') }}">
        @error('building')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit" class="update-btn">更新する</button>
</form>
</div>
@endsection