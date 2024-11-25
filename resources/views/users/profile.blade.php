@extends('layouts.login')

@section('content')
<div id="container">

  <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="profile-area">
      @if(Auth::user()->images === null)
      <!-- 初期画像として icon1.png を表示 -->
      <img src="{{ asset('images/icon1.png') }}" width="50" height="50">
    @else
      <img src="{{ asset('storage/images/' . Auth::user()->images) }}" width="50" height="50">
    @endif

      <div class="formArea">
        <div class="formIconName">
          <div class="form-group">
            <label for="username">ユーザー名</label>
            <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
            @error('username')
        <div class="text-danger">{{ $message }}</div>
      @enderror
          </div>
        </div>

        <div class="form-group">
          <label for="mail">メールアドレス</label>
          <input type="mail" id="mail" name="mail" class="form-control" value="{{ old('mail', $user->mail) }}" required>
          @error('mail')
        <div class="text-danger">{{ $message }}</div>
      @enderror
        </div>

        <div class="form-group">
          <label for="password">パスワード</label>
          <input type="password" id="password" name="password" class="form-control" required>
          @error('password')
        <div class="text-danger">{{ $message }}</div>
      @enderror
        </div>

        <div class="form-group">
          <label for="password_confirmation">パスワード確認 </label>
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
          @error('password_confirmation')
        <div class="text-danger">{{ $message }}</div>
      @enderror
        </div>

        <div class="form-group">
          <label for="bio">自己紹介</label>
          <input type="bio" id="bio" name="bio" class="form-control" value="{{ old('bio', $user->bio) }}">
          @error('bio')
        <div class="text-danger">{{ $message }}</div>
      @enderror
        </div>

        <div class="form-group">
          <label for="images">アイコン画像</label>
          <input type="file" id="images" name="images" class="form-control">
          @if($user->images)
      @endif
          @error('images')
        <div class="text-danger">{{ $message }}</div>
      @enderror
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </div>
    </div>
  </form>
</div>
@endsection
