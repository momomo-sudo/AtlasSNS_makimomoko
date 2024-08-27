@extends('layouts.login')

@section('content')


<h3>ここは検索ページ！</h3>


<div>
  <div>
    <!-- 検索フォーム -->
    <form action="{{ route('users.search') }}" method="GET"> <!-- POST?? -->
      <!-- routeの中にフォームの送信先となるルートの名前を指定する -->
      @csrf
      <input type="text" name="username" placeholder="ユーザー名">
      <input type="image" src="{{ asset('/images/search.png') }}">

      <!-- 検索ワードを表示 -->
      @if(request()->input('username'))
      <span>検索ワード： {{ request()->input('username') }}</span>

    @endif
    </form>
  </div>

  <!-- 検索結果の表示-->
  <div class="table-responsive">
    <table class="table" style="border-collapse: separate">

      @foreach($users as $user) <!-- assetの$user -->
        <!-- 検索したら、usernameと、imagesを表示する -->
        @if ($user->id !== Auth::user()->id)<!-- この部分でテーブルに登録されているユーザーとログインしているユーザーが不一致のユーザー(要するに自分以外)の表示 -->
        <!-- table rowの略で表の行部分（横方向）を指定するタグ-->
        <div class="images"><img width="40" height="40" src="{{ asset('storage/images/' . $user->images) }}" class="username">{{$user->username}}
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
        </div>
        </div>
        <!-- usersテーブルのusernameカラムを出したい(一人ずつの情報を出したいから単数系の$userを使う)-->

      @endif
    @endforeach
  </table>
</div>
</div>

@endsection
