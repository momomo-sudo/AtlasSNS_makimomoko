@extends('layouts.logout')

@section('content')

<p class="login_title">AtlasSNSへようこそ</p>

{!! Form::open(['url' => '/login', 'class' => 'form_area']) !!}
<div class="form">
  {{ Form::label('メールアドレス') }}
  <div class="form_input">
    {{ Form::text('mail', null, ['class' => 'input']) }}
  </div>
</div>
<div class="form">
  {{ Form::label('パスワード') }}
  <div class="form_input">
    {{ Form::password('password', ['class' => 'input']) }}
  </div>
</div>
{{ Form::submit('ログイン', ['class' => 'btn-block'])}}
{!! Form::close() !!}

<p class="login_link"><a href="/register">新規ユーザーの方はこちら</a></p>

@endsection
