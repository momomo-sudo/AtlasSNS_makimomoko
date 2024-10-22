@extends('layouts.logout')

@section('content')

<h2 class="login_title">新規ユーザー登録</h2>

{!! Form::open(['url' => '/register']) !!}
{{ Form::label('ユーザー名') }}
{{ Form::text('username', null, ['class' => 'input']) }}

{{ Form::label('メールアドレス') }}
{{ Form::text('mail', null, ['class' => 'input']) }}

{{ Form::label('パスワード') }}
{{ Form::password('password', ['class' => 'input']) }}

{{ Form::label('パスワード確認') }}
{{ Form::password('password_confirmation', ['class' => 'input']) }}

{{ Form::submit('新規登録', ['class' => 'btn-block']) }}
{!! Form::close() !!}

<p class="login_link"><a href="/login">ログイン画面に戻る</a></p>

@endsection
