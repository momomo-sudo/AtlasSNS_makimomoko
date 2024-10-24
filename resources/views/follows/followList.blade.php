@extends('layouts.login')

@section('content')


<body>
  <div id="container">
    <ul>
      <!-- フォローしている人のアイコン表示 -->
      @foreach($followed as $user)
      <li>
      @if($user->images)
      <img src="{{ asset('storage/images/' . $user->images) }}" alt="{{ $user->name }}のアイコン" style="width: 50px; height: 50px; border-radius: 50%;">
    @endif
      {{ $user->name }}
      </li>
    @endforeach

      <div class="follow-list">
        <h1>あなたがフォローしているユーザーの投稿</h1>
      </div>
      <ul>
        <!-- フォローしている人の投稿一覧 -->
        <div class="follow-post">
          <!-- ユーザーの投稿 -->
          @foreach ($posts as $post) <!-- 各投稿($post)に対して行いたい処理を書く -->
        <tr>
        <p><a href="{{ route('follows.profile', ['id' => $post->user->id]) }}"><img src="{{ asset('storage/images/' . $post->user->images) }}" alt="ユーザーアイコン" style="width: 50px; height: 50px;">
      </a></p>

        <td>{{ $post->user->username }}</td>
        <!-- $postはPostcontrollerで定義している。userがPostモデルに定義したメソッド。imagesがテーブルのカラム名 -->
        <td>{{ $post->post }}</td>
        <td>{{ $post->user->created_at }}</td>
    @endforeach
        </div>
      </ul>
    </ul>
  </div>
</body>
@endsection
