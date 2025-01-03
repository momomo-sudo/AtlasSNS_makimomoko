@extends('layouts.login')  <!-- leyoutsフォルダ内のlogin.blade.phpを親を親テンプレートとして指定し、ここのテンプレート（子テンプレ）が親テンプレの構造を継承する。共通のレイアウトや構造を複数のビューで再利用できる -->

@section('content') <!-- 子テンプレート側でcontentセクションに表示されるコンテンツを定義する。親テンプレート(login.blade.php)の、@yield('content')の位置に挿入される。 -->

<!-- 投稿フォーム -->
<div id="container">
  <form action="{{ route('post.store') }}" method="POST"> <!-- 名前付きルート post.store に対応するURLを生成します -->
    <!-- routeの中にフォームの送信先となるルートの名前を指定する -->
    <!-- getとPOST、情報を登録するときはPOST、検索するときや画面を表示するときはGET -->
    @csrf
    <div class="post_form">
      <!-- バリデーションメッセージ -->
      <!-- 初期画像として icon1.png を表示 -->
      <img src="{{ $user->images && $user->images !== 'icon1.png' ? asset('storage/images/' . $user->images) : asset('images/icon1.png') }}" width="50" height="50">

      <input type="text" name="content" placeholder="投稿内容を入力してください。">
      <button type="submit" class="button"> <img class="post-btn" src="images/post.png"></button>
      @if ($errors->has('content'))
      <div class="content-alert">
      <ul>
        @foreach($errors->get('content') as $message)
      <li>{{ $message }}</li>
    @endforeach
      </ul>
      </div>
    @endif
    </div>
  </form>

  <!-- 自分と、フォローしてる人の投稿を表示 -->
  <!-- バリデーションメッセージ -->
  @if ($errors->has('post'))
    <div class="post-alert">
    <ul>
      @foreach($errors->get('post') as $message)
      <li>{{ $message }}</li>
    @endforeach
    </ul>
    </div>
  @endif

  @foreach ($posts as $post) <!-- 各投稿($post)に対して行いたい処理を書く -->
    <ul class="postLine">
    <li class="post-block">
    <div class="post">
    <figure>
    <!-- 初期画像として icon1.png を表示 -->
    <img src="{{ $post->user->images && $post->user->images !== 'icon1.png' ? asset('storage/images/' . $post->user->images) : asset('images/icon1.png') }}" width="50" height="50" class="user-icon">
    </figure>
    <div class="post-content">
    <div class="post-name">{{ $post->user->username }}</div>
    <div class="created_at">{{ $post->user->created_at }}</div>
    <!-- $postはPostcontrollerで定義している。userがPostモデルに定義したメソッド。-->
    <div>{{ $post->post }}</div>
    </div>

    @if ($user_id == $post->user_id)
    <!-- ↑これで自分の投稿のみ編集・削除できる -->
    </div>

    <!-- モーダルの実装（編集機能） -->
    <div class="button_area">
    <div class="content">
    <!-- 投稿の編集ボタン -->
    <a class="js-modal-open" href="#" post="{{ $post->post }}" post_id="{{ $post->id }}"></a>
    </div>

    <!-- モーダルの中身 -->
    <div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
    <form action="" method="POST">
    @method('PATCH')
    {{ csrf_field() }}
    <textarea name="post" class="modal_post"></textarea>
    <input type="hidden" name="id" class="modal_id" value="{{ $post->id }}">

    <input type="submit" class="modal-btn" value="">
    <!-- valueを無しにすることで「送信」の文字が消える　 -->
    </form>
    </div>
    </div>

    <!-- 削除機能 -->
    <form action="{{ route('post.delete', $post->id) }}" method="POST" onsubmit="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
    @csrf
    @method('GET')
    <button class="btn_delete"></button>
    </form>
    </div>
    @endif
    </li>
    </ul>

  @endforeach
</div>
@endsection
