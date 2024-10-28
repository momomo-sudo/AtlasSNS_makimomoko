@extends('layouts.login')

@section('content')


<body>
  <div id="container">

    <!-- 検索フォーム -->
    <form action="{{ route('users.search') }}" method="GET"> <!-- POST?? -->
      <!-- routeの中にフォームの送信先となるルートの名前を指定する -->
      @csrf
      <div class="main_area">
        <div class="main_child">
          <input type="text" name="username" placeholder="ユーザー名" class="search-form">
          <input type="image" class="magnifying-glass" src="{{ asset('/images/search.png') }}">

          <!-- 検索ワードを表示 -->
          @if(request()->input('username'))
        <span>検索ワード： {{ request()->input('username') }}</span>

      @endif
        </div>
      </div>
    </form>


    <!-- 検索結果の表示-->

    <div class="searchArea">

      <table class="table" style="border-collapse: separate">

        @foreach($users as $user) <!-- assetの$user -->
      @if ($user->id !== Auth::user()->id)<!-- この部分でテーブルに登録されているユーザーとログインしているユーザーが不一致のユーザー(要するに自分以外)の表示 -->
      <!-- table rowの略で表の行部分（横方向）を指定するタグ-->
      <ul class='search'>
      <li class="searchList">
      <!-- 検索したら、usernameと、imagesを表示する -->

      <img width="40" height="40" src="{{ asset('storage/images/' . $user->images) }}" class="username">{{$user->username}}
      <!-- $userのimagesカラム（カラム名） -->
      <!-- asset→publicディレクトリ内のファイルのURLを生成するための関数-->
      <!-- td→table dataの略。セルの内容がデータの場合は、この<td>要素を使用する。-->
      <!-- thは一番上の行や見出し、tdは２行目以降(データ)の内容 -->

      <!-- フォロー・フォロー解除ボタン -->
      <form method="POST" action="{{ route('users.follow') }}">
        @csrf
        <input name="followed_id" type="hidden" value="{{ $user->id }}" />
        <!--nameでコントローラーにfollowed_idを送ってる-->
        @if($user->isFollow())
      <button type="submit" style="background-color: #efc9d2;">
      フォロー解除
      </button>
    @else
    <button type="submit" style="background-color: #ccffcc;">
    フォローする
    </button>
  @endif
      </form>

  @endif
        </li>
      </ul>
    @endforeach
      </table>

    </div>
    <!-- usersテーブルのusernameカラムを出したい(一人ずつの情報を出したいから単数系の$userを使う)-->

  </div>
</body>
@endsection
