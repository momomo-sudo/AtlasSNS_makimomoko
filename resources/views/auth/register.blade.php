@extends('layouts.logout')

@section('content')

<h2 class="login_title">新規ユーザー登録</h2>

<div class="form">
  {!! Form::open(['url' => '/register', 'class' => 'form_area']) !!}
  {{ Form::label('ユーザー名') }}
  <div class="form_input">
    {{ Form::text('username', null, ['class' => 'input']) }}
  </div>
</div>
@if ($errors->has('username'))
  <div class="alert alert-danger">
    <ul>
    @foreach($errors->get('username') as $message)
    <li>{{ $message }}</li>
  @endforeach
    </ul>
  </div>
@endif

<div class="form">
  {{ Form::label('メールアドレス') }}
  <div class="form_input">
    {{ Form::text('mail', null, ['class' => 'input']) }}
  </div>
</div>
@if ($errors->has('mail'))
  <div class="alert alert-danger">
    <ul>
    @foreach($errors->get('mail') as $message)
    <li>{{ $message }}</li>
  @endforeach
    </ul>
  </div>
@endif

<div class="form">
  {{ Form::label('パスワード') }}
  <div class="form_input">
    {{ Form::password('password', ['class' => 'input']) }}
  </div>
</div>
@if ($errors->has('password'))
  <div class="alert alert-danger">
    <ul>
    @foreach($errors->get('password') as $message)
    <li>{{ $message }}</li>
  @endforeach
    </ul>
  </div>
@endif
<div class="form">
  {{ Form::label('パスワード確認') }}
  <div class="form_input">
    {{ Form::password('password_confirmation', ['class' => 'input']) }}
  </div>
</div>
@if ($errors->has('password_confirmation'))
  <div class="alert alert-danger">
    <ul>
    @foreach($errors->get('password_confirmation') as $message)
    <li>{{ $message }}</li>
  @endforeach
    </ul>
  </div>
@endif

{{ Form::submit('新規登録', ['class' => 'btn-block']) }}
{!! Form::close() !!}

<p class="login_link"><a href="/login">ログイン画面に戻る</a></p>

@endsection
