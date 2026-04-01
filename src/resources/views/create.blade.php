@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="sell-container">

<h2 class="sell-title">商品の出品</h2>

{{-- エラー表示 --}}
@foreach ($errors->all() as $error)
  <p style="color:red;">{{ $error }}</p>
@endforeach

<form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<!-- 商品画像 -->
<div class="section-title-img">商品画像</div>

<div class="image-upload">
<label class="upload-btn">
画像を選択する
<input type="file" name="image">
</label>
<img id="preview">
</div>

<!-- 商品の詳細 -->
<div class="section-title">商品の詳細</div>

<div class="form-category-group">
<label>カテゴリー</label>

<div class="category-group">

@foreach($categories as $category)
<label class="category-item">
<input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
<span>{{ $category->name }}</span>
</label>
@endforeach

</div>
</div>

<div class="form-group">
<label>商品の状態</label>

<select name="condition">
<option value="" disabled {{ old('condition') ? '' : 'selected' }}>選択してください</option>

@foreach($conditions as $condition)
<option value="{{ $condition->id }}" {{ old('condition') == $condition->id ? 'selected' : '' }}>
{{ $condition->name }}
</option>
@endforeach

</select>
</div>

<!-- 商品名と説明 -->

<div class="section-title">商品名と説明</div>

<div class="form-group">
<label>商品名</label>
<input type="text" name="name" value="{{ old('name') }}">
</div>

<div class="form-group">
<label>ブランド名</label>
<input type="text" name="brand" value="{{ old('brand') }}">
</div>

<div class="form-group">
<label>商品の説明</label>
<textarea name="description">{{ old('description') }}</textarea>
</div>

<div class="form-group">
<label>販売価格</label>
<input type="number" name="price" value="{{ old('price') }}" placeholder="¥">
</div>

<div class="sell-button">
<button type="submit">出品する</button>
</div>

</form>

<script>
document.querySelector('input[name="image"]').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview');

    if (file) {
        preview.src = URL.createObjectURL(file);
    }
});
</script>

</div>
@endsection