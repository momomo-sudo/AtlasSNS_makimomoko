@extends('layouts.login')

@section('content')
<h3>ここはプロフィールページです。</h3>
<div>
  <!-- <form action="{{ route('post.store') }}" method="POST"> 名前付きルート post.store に対応するURLを生成します -->
  <div>
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <img src="{{ asset('storage/images/' . Auth::user()->images) }}">
      <div class="form-group">
        <label for="username">名前</label>
        <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
        @error('username')
      <div class="text-danger">{{ $message }}</div>

    @enderror
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
        <label for="images">プロフィール画像</label>
        <input type="file" id="images" name="images" class="form-control">
        @if($user->images)
    @endif
        @error('images')
      <div class="text-danger">{{ $message }}</div>
    @enderror
      </div>

      <button type="submit" class="btn btn-primary">更新</button>
    </form>
  </div>
  @endsection
