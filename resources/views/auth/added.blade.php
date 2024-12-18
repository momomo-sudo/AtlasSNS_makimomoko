@extends('layouts.logout')

@section('content')

<div id="clear">
  <div class="registration-complete">
    <!-- 登録したユーザー名表示-->
    <p class="username">{{ session('username') }}さん</p>
    <p>ようこそ！AtlasSNSへ！</p>
  </div>

  <div class="welcome-message">
    <p>ユーザー登録が完了しました。</p>
    <p>早速ログインをしてみましょう！</p>
  </div>
  <p ><a href="/login" class="btn">ログイン画面へ</a></p>
</div>

@endsection
