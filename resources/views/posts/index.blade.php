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
      <img src="{{ asset('/images/icon1.png') }}">
      <input type="text" name="content" placeholder="投稿内容を入力してください。">
      <input type="image" src="{{ asset('/images/post.png') }}">
  </form>
  @foreach ($posts as $post)
    <tr>
    <td>{{ $post->user->images }}</td>
    <td>{{ $post->user->username }}</td>
    <!-- $postはPostcontrollerで定義している。userがPostモデルに定義したメソッド。imagesがテーブルのカラム名 -->
    <td>{{ $post->post }}</td>
    <td>{{ $post->user->created_at }}</td>
    <!-- <td><a class="btn btn-primary" href="/posts/{{$post->id}}/edit">>編集</a></td> -->
    <!-- クラス名btn-primaryは、cssでレイアウトを反映するため
     <a>タグのhref属性に各リストのidカラムの値が表示されるように設置した-->

    <!-- 編集機能 -->
    <td><a href="{{ route('post.edit', ['id' => $post->user_id]) }}" class="btn btn-info">編集</a></td>

    <!-- 削除機能 -->
    <td><a href="{{ route('post.delete', ['id' => $post->user_id]) }}" class="btn  btn-danger" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></td>
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
