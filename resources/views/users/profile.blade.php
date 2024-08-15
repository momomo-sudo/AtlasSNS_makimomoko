@extends('layouts.login')

@section('content')
<h3>ここはプロフィールページです。</h3>
<div>
  <!-- <form action="{{ route('post.store') }}" method="POST"> 名前付きルート post.store に対応するURLを生成します -->
  <div>
    <img src="{{ asset('/images/icon1.png') }}">
    <p>user name<textarea name="content" placeholder="投稿内容を入力してください。"></textarea></p>
    <p>mail adress<textarea name="content" placeholder="投稿内容を入力してください。"></textarea></p>
    <p>password<textarea name="content" placeholder="投稿内容を入力してください。"></textarea></p>
    <p>password comfirm<textarea name="content" placeholder="投稿内容を入力してください。"></textarea></p>
    <p>bio<textarea name="content" placeholder="投稿内容を入力してください。"></textarea></p>
    <p>icon imaage<textarea name="content" placeholder="投稿内容を入力してください。"></textarea></p>

    <button>更新</button>
  </div>
  </form>
</div>

@endsection
