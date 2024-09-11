@extends('layouts.login')  <!-- leyoutsフォルダ内のlogin.blade.phpを親を親テンプレートとして指定し、ここのテンプレート（子テンプレ）が親テンプレの構造を継承する。共通のレイアウトや構造を複数のビューで再利用できる -->

@section('content') <!-- 子テンプレート側でcontentセクションに表示されるコンテンツを定義する。親テンプレート(login.blade.php)の、@yield('content')の位置に挿入される。 -->

<h2>トップページです</h2>

<!-- 投稿フォーム -->
<div>

  <form action="{{ route('post.store') }}" method="POST"> <!-- 名前付きルート post.store に対応するURLを生成します -->
    <!-- routeの中にフォームの送信先となるルートの名前を指定する -->
    <!-- getとPOST、情報を登録するときはPOST、検索するときや画面を表示するときはGET -->
    @csrf
    <div>
      <img src="{{ asset('storage/images/' . Auth::user()->images) }}" width="40" height="40">
      <input type="text" name="content" placeholder="投稿内容を入力してください。">
      <div class="button">
        <button type="submit"> <img class="post-btn" src="images/post.png" style="width: 50px; height: 50px;"></button>
      </div>
  </form>

  <!-- 自分と、フォローしてる人の投稿を表示 -->
  @foreach ($posts as $post) <!-- 各投稿($post)に対して行いたい処理を書く -->
    <tr>
    <td><img src="{{ asset('storage/images/' . $post->user->images) }}" alt="ユーザーアイコン" style="width: 50px; height: 50px;"></td>

    <td>{{ $post->user->username }}</td>
    <!-- $postはPostcontrollerで定義している。userがPostモデルに定義したメソッド。imagesがテーブルのカラム名 -->
    <td>{{ $post->post }}</td>
    <td>{{ $post->user->created_at }}</td>


    <!-- 編集ボタン↓ -->
    @if ($user_id == $post->user_id)
    <form action="{{ route('post.edit', $post->id) }}">
      <button class="btn_edit"></button>
      <!-- HTTPの通信方法をGETにして、URLにパラメータを一緒に送れるようにする -->
      <!-- aタグのhref属性に各リストのidカラムの値が表示されるように設置をした -->
      <style>
      .btn_edit {
      width: 50px;
      height: 50px;
      background-image: url('images/edit.png');
      background-size: cover;
      /* 背景画像をボタン全体に合わせる */
      background-position: center;
      /* 画像の位置を中央に設定 */
      border: none;
      /* ボーダーを非表示 */
      cursor: pointer;
      }
      </style>
    </form>

  @endif

    <!-- 削除機能 -->
    @if ($user_id == $post->user_id)
    <form action="{{ route('post.delete', $post->id) }}" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
      <button class="btn_delete"></button>
      <style>
      .btn_delete {
      width: 50px;
      height: 50px;
      background-image: url('images/trash-h.png');
      background-size: cover;
      /* 背景画像をボタン全体に合わせる */
      background-position: center;
      /* 画像の位置を中央に設定 */
      border: none;
      /* ボーダーを非表示 */
      cursor: pointer;
      }

      .btn_delete:hover {
      background-image: url('images/trash.png');
      -webkit-transition: .2s ease-in-out;
      transition: .2s ease-in-out;
      }
      </style>

    </form>
  @endif
    <!-- ・ユーザーアイコン
    ・ユーザー名
    ・投稿内容
    ・投稿日時
    ・投稿編集ボタン
    ・投稿削除ボタン -->
    </tr>
  @endforeach
</div>


</div>

@endsection
