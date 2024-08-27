@extends('layouts.login')

@section('content')
<!--モーダルの中身-->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal_content">
    <form action="{{ route('post.update', ['id' => $post->id]) }}" method="POST">
      <!-- idというキーに$post->idの値を割り当てている。
  //例→$post->idが5であれば、このコードは/posts/5というURLを生成する -->
      @csrf
      <textarea name="upPost" class="moaal_post"></textarea>
      <input type="hidden" name="post_id" class="modal_id" value="">
      <input type="submit" value="更新">
      <!-- taxtareaの所は編集したい投稿の内容を送っていて
      postidの行はどの投稿を編集したいのかを特定するidを送っている -->
    </form>
    <a class="js-modal-close" href="{{ route('posts.index') }}">閉じる</a>
  </div>
</div>
@endsection
