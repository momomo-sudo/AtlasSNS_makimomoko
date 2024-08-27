@extends('layouts.login')

@section('content')

<h3>ここはフォローリストのページです。</h3>


<body>
  <h1>あなたがフォローしているユーザーのアイコン</h1>
  <ul>
    @foreach($followed as $user)
    <li>
      @if($user->images)
      <img src="{{ asset('storage/images/' . $user->images) }}" alt="{{ $user->name }}のアイコン" style="width: 50px; height: 50px; border-radius: 50%;">
    @endif
      {{ $user->name }}
    </li>
  @endforeach
  </ul>
</body>


@endsection
