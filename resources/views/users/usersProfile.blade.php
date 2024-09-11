@extends('layouts.login')

@section('content')
@foreach ($posts as $post) <!-- 各投稿($post)に対して行いたい処理を書く -->
  <div class="profile">
    <div class="profile-header">

    <!-- ユーザーの投稿 -->

    <tr>
      <!-- ユーザーのアイコン -->
      <p><a href="{{ route('follows.profile', ['id' => $post->user->id]) }}"><img src="{{ asset('storage/images/' . $post->user->images) }}" alt="ユーザーアイコン" style="width: 50px; height: 50px;">
    </a></p>

      <td>{{ $post->user->username }}</td><!-- ユーザーの名前 -->
      <!-- $postはPostcontrollerで定義している。userがPostモデルに定義したメソッド。imagesがテーブÏルのカラム名 -->
      <td>{{ $user->bio }}</td><!-- ユーザーの自己紹介文 -->
      <td>{{ $post->user->created_at }}</td>
      <!-- フォロー・フォロー解除ボタン -->
      <form method="POST" action="{{ route('users.follow') }}">
      @csrf
      <input name="followed_id" type="hidden" value="{{ $post->user->id }}" />
      <!--nameでコントローラーにfollowed_idを送ってる-->
      @if(Auth::user()->follows()->where('followed_id', $user->id)->exists())
      <!-- $user->isFollow())だと$userがフォローしている人になる（フォローリストから選んだ人） -->
      <!-- これだと、Auth::user()->follows() でログインしているユーザーがフォローしているユーザーを取得。
      where('followed_id', $user->id) で、表示しているユーザー（$user）がフォローされているかをチェック。
      exists() で該当のフォローが存在するかどうかを判定し、フォローしているかどうかを確認する -->

      <button type="submit" style="background-color: #efc9d2;">
      フォロー解除
      </button>
    @else
      <button type="submit" style="background-color: #ccffcc;">
      フォローする
      </button>
    @endif
      </form>
  @endforeach
      <div class="profile-body">
        <!-- ユーザーの投稿 -->
        @foreach ($posts as $post) <!-- 各投稿($post)に対して行いたい処理を書く -->
      <tr>
        <p><a href="{{ route('follows.profile', ['id' => $post->user->id]) }}"><img src="{{ asset('storage/images/' . $post->user->images) }}" alt="ユーザーアイコン" style="width: 50px; height: 50px;">
        </a></p>

        <td>{{ $post->user->username }}</td>
        <!-- $postはPostcontrollerで定義している。userがPostモデルに定義したメソッド。imagesがテーブルのカラム名 -->
        <td>{{ $post->post }}</td>
      @endforeach
  </div>
</div>
</div>
</div>
@endsection
