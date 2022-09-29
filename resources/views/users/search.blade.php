@extends('layouts.login')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<section class="search">
    {!! Form::open(["url" => "search"]) !!}
        {{ Form::text('post',null,['class'=>'search_username','required', 'placeholder'=>"ユーザー名"]) }}
        {{ Form::submit('',['class'=>'post_search']) }}
    {!! Form::close() !!}
</section>

<section class="display_message">

</section>


@endsection
