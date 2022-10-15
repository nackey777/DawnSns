@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<h2>DAWNのSNSへようこそ</h2>

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}
{{ Form::label('パスワード') }}
{{ Form::password('password',['class' => 'input']) }}

{{ Form::submit('ログイン',['class' => 'button right']) }}

<p class="backLink"><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

@endsection
