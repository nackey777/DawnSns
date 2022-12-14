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
    @if($datas->isEmpty())
        <p>「{{$search_word}}」に一致するユーザーは存在しません</p>
    @else
        @foreach ($datas as $data)
            @if($data -> id == Auth::id())
                <!-- 本人は対象外 -->
            @else
                <div class="search_wrapper">
                    <a href="/profile/{{ $data -> id }}">
                        <img class="userface" src="{{ $data -> image }}">
                    </a>
                    <p class="confirm_username">{{ $data -> username }}</p>
                    @if(in_array($data -> id, $follow_ids))
                        <p class="btn unfollow_button">
                            <a href="/unfollow/?follow_id={{Auth::id()}}&follower_id={{ $data -> id }}">フォローをはずす</a>
                        </p>
                    @else
                        <p class="btn follow_button">
                            <a href="/follow/?follow_id={{Auth::id()}}&follower_id={{ $data -> id }}">フォローする</a>
                        </p>
                    @endif
                </div>
            @endif
        @endforeach
    @endif

</section>
@endsection
