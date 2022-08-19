@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<h2>DAWNSNSへようこそ</h2>

{{ Form::label('e-mail') }}
{{ Form::text('mail',null,['class' => 'input']) }}
{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}

{{ Form::submit('ログイン',['class' => 'button right']) }}

<p class="backLink"><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

@endsection
