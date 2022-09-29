@extends('layouts.login')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<section class="search">
    {!! Form::open(["url" => "search"]) !!}
        {{ Form::text('search_username',null,['class'=>'search_username','required', 'placeholder'=>"ユーザー名"]) }}
        {{ Form::submit('',['class'=>'post_search']) }}
        @if($search_word != "")
            <p class="search_word">検索ワード：{{$search_word}}</p>
        @endif
    {!! Form::close() !!}
</section>

<section class="search_confirm">
    @foreach ($datas as $data)
        <div class="search_wrapper">
            <img class="userface" src="images/{{ $data -> image }}">
            <p class="confirm_username">{{ $data -> username }}</p>
            <p class="btn follow_button"><a href="{{ $data -> id }}">フォローする</a></p>
        </div>
    @endforeach

</section>


@endsection
