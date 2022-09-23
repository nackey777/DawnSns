@extends('layouts.login')
@section('content')

{!! Form::open(["url" => "post"]) !!}
<img class="post_face" src="images/dawn.png">
{{ Form::hidden('user_id',Auth::id())}}
{{ Form::textarea('post',null,['class'=>'post_input','required', 'placeholder'=>"何をつぶやこうか...?"]) }}
{{ Form::submit('',['class'=>'post_submit']) }}
{!! Form::close() !!}

@endsection
