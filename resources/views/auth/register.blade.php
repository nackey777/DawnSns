@extends('layouts.logout')

@section('content')



{!! Form::open(["url" => "register"]) !!}

<h2>新規ユーザー登録</h2>

<div class="createUserForm {{$errors->has('username') ? 'has-error' : ''}}">
    {{ Form::label('ユーザー名') }}
    {{ Form::text('username',null,['class' => 'input','required']) }}
    @if ($errors->has('username'))
        <p class="error">{{$errors->first('username')}}</p>
    @endif
</div>

<div class="createUserForm {{$errors->has('mail') ? 'has-error' : ''}}">
    {{ Form::label('メールアドレス') }}
    {{ Form::text('mail',null,['class' => 'input','required']) }}
    @if ($errors->has('mail'))
        <p class="error">{{$errors->first('mail')}}</p>
    @endif
</div>

<div class="createUserForm {{$errors->has('password') ? 'has-error' : ''}}">
    {{ Form::label('パスワード') }}
    {{ Form::text('password',null,['class' => 'input','required']) }}
    @if ($errors->has('password'))
        <p class="error">{{$errors->first('password')}}</p>
    @endif
</div>

<div class="createUserForm {{$errors->has('password-confirm') ? 'has-error' : ''}}">
    {{ Form::label('パスワード確認') }}
    {{ Form::text('password-confirm',null,['class' => 'input', 'required']) }}
    @if ($errors->has('password-confirm'))
       <p class="error">{{$errors->first('password-confirm')}}</p>
    @endif
</div>

{{ Form::submit('登録',['class' => 'button right']) }}

<p class="backLink"><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection

<script type="text/javascript">
  window.addEventListener("DOMContentLoaded", function() {
    document.getElementsByName("password-confirm")[0].value = "";
  });
</script>
