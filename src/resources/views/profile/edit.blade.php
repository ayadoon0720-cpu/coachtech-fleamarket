@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/initial.css') }}">
@endsection

@section('content')
<div class="profile-wrapper">
    <div class="profile-card">
      <h2 class="title">プロフィール設定</h2>
      <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
       @csrf
          <div class="image-area">
            <div class="avatar">
                <img id="preview" src="{{ $user->profile_image ? asset('images/' . $user->profile_image) : '' }}">
            </div>
            <label class="image-btn">
                画像を選択する
                <input type="file" name="image" id="imageInput">
            </label>
          </div>
          <div class="form-area">
            <label>ユーザー名</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}">
                  <label>郵便番号</label>
                <input type="text" name="postal_code" value="{{ old('postal_code', auth()->user()->address->postal_code ?? '') }}">
                  <label>住所</label>
                <input type="text" name="address" value="{{ old('address', auth()->user()->address->address ?? '') }}">
                  <label>建物名</label>
                <input type="text" name="building" value="{{ old('building', auth()->user()->address->building ?? '') }}">
                <button class="update-btn">
                    更新する
                </button>
          </div>
       </form>
    </div>
</div>

<script>

document
.getElementById("imageInput")
.addEventListener("change", function(e) {

    const file = e.target.files[0];

    if (file) {

        const reader = new FileReader();

        reader.onload = function(e) {

            document
            .getElementById("preview")
            .src = e.target.result;

        };

        reader.readAsDataURL(file);

    }

});

</script>
@endsection