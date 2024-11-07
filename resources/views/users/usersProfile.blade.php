@extends('layouts.login')

@section('content')

<div id="container">
  <ul>
    <div class="Userpost_form">
      <div class="Userpost_form2">
        <!-- ユーザーのアイコン -->
        <p><img src="{{ asset('storage/images/' . $user->images) }}" alt="ユーザーアイコン"></p>
        <div>
          <div class="user-name">
            <p class="UserpageUsername">ユーザー名</p>
            <p>{{ $user->username }}</p><!-- ユーザーの名前 -->
            <!-- $postはPostcontrollerで定義している。userがPostモデルに定義したメソッド。imagesがテーブÏルのカラム名 -->
          </div>
          <div class="user-bio">
            <p class="UserpageBio">自己紹介</p>
            <p>{{ $user->bio }}</p><!-- ユーザーの自己紹介文 -->
          </div>
        </div>
      </div>
      <!-- フォロー・フォロー解除ボタン -->
      <div class="userProfileBtn">
        <form method="POST" action="{{ route('users.follow') }}">
          @csrf
          <input name="followed_id" type="hidden" value="{{ $user->id }}" />
          <!--nameでコントローラーにfollowed_idを送ってる-->
          @if(Auth::user()->follows()->where('followed_id', $user->id)->exists())
          <!-- $user->isFollow())だと$userがフォローしている人になる（フォローリストから選んだ人） -->
          <!-- これだと、Auth::user()->follows() でログインしているユーザーがフォローしているユーザーを取得。
        where('followed_id', $user->id) で、表示しているユーザー（$user）がフォローされているかをチェック。
        exists() で該当のフォローが存在するかどうかを判定し、フォローしているかどうかを確認する -->

          <button type="submit" class="userFollow-btn">
          フォロー解除
          </button>
      @else
      <button type="submit" class="userUnfollow-btn">
      フォローする
      </button>
    @endif
        </form>
      </div>
    </div>


    <div class="profile-body">

      <!-- ユーザーの投稿 -->
      @foreach ($posts as $post) <!-- 各投稿($post)に対して行いたい処理を書く -->
      <ul class="postLine">
      <li class="post-block">
        <div class="post">
        <p><img src="{{ asset('storage/images/' . $post->user->images) }}" alt="ユーザーアイコン"></p>
        <div class="post-content">
          <div class="post-name">{{ $post->user->username }}</div>
          <div class="created_at">{{ $post->user->created_at }}</div>
          <!-- $postはPostcontrollerで定義している。userがPostモデルに定義したメソッド。imagesがテーブルのカラム名 -->
          <div>{{ $post->post }}</div>
        </div>
        </div>
      </li>
      </ul>
    @endforeach
    </div>
  </ul>
</div>

@endsection
