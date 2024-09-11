@extends('layouts.login')

@section('content')

<h3>ここはフォロワーリストのページです</h3>
<body>
  <ul>
    @foreach($followers as $user)
    <li>
      @if($user->images)
      <img src="{{ asset('storage/images/' . $user->images) }}" alt="{{ $user->name }}のアイコン" style="width: 50px; height: 50px; border-radius: 50%;">
    @endif
      {{ $user->name }}
    </li>
  @endforeach

    <h1>あなたがフォローされているユーザーの投稿</h1>
    <ul>
      @foreach ($posts as $post) <!-- 各投稿($post)に対して行いたい処理を書く -->
      <tr>
      <p><a href="{{ route('follows.profile', ['id' => $post->user->id]) }}"><img src="{{ asset('storage/images/' . $post->user->images) }}" alt="ユーザーアイコン" style="width: 50px; height: 50px;">
    </a></p>

      <p>名前：{{ $post->user->username }}</p>
      <!-- $postはPostcontrollerで定義している。userがPostモデルに定義したメソッド。imagesがテーブルのカラム名 -->
      <p>投稿内容：{{ $post->post }}</p>
      <td>{{ $post->user->created_at }}</td>
  @endforeach

    </ul>
  </ul>
</body>
@endsection
