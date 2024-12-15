@extends('layouts.login')

@section('content')


<body>
  <div id="container">
    <ul>
      <div class="main_area">
        <h1>フォローリスト</h1>
        <div class="followListIcon">
          <!-- フォローしている人のアイコン表示 -->
          @foreach($followed as $user)
          <li>

          @if($user->images)
        <a href="{{ route('follows.profile', ['id' => $user->id]) }}">
        <!-- 初期画像として icon1.png を表示 -->
        <img src="{{ $user->images && $user->images !== 'icon1.png' ? asset('storage/images/' . $user->images) : asset('images/icon1.png') }}"></a>
    @endif
          {{ $user->name }}
          </li>
      @endforeach
        </div>
      </div>
      <ul class="f-postArea">
        <!-- フォローしている人の投稿一覧 -->
        <!-- ユーザーの投稿 -->
        @foreach ($posts as $post) <!-- 各投稿($post)に対して行いたい処理を書く -->
          <ul class="postLine">
          <li class="post-block">
          <div class="post">
          <a href="{{ route('follows.profile', ['id' => $post->user->id]) }}">
            <img src="{{ $post->user->images && $post->user->images !== 'icon1.png' ? asset('storage/images/' . $post->user->images) : asset('images/icon1.png') }}" class="user-icon">
          </a>
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
      </ul>
    </ul>
  </div>
</body>
@endsection
