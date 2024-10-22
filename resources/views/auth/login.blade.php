@extends('layouts.logout')

@section('content')

<p class="login_title">AtlasSNSへようこそ</p>

{!! Form::open(['url' => '/login', 'class' => 'form_area']) !!}
{{ Form::label('メールアドレス') }}
{{ Form::text('mail', null, ['class' => 'input']) }}
{{ Form::label('パスワード') }}
{{ Form::password('password', ['class' => 'input']) }}
{{ Form::submit('ログイン', ['class' => 'btn-block'])}}
{!! Form::close() !!}

<p class="login_link"><a href="/register">新規ユーザーの方はこちら</a></p>

@endsection
