@extends('layouts.login')
@section('content')

{!! Form::open(["url" => "post"]) !!}
<img class="post_face" src="images/dawn.png">
{{ Form::hidden('user_id',Auth::id())}}
{{ Form::textarea('post',null,['class'=>'post_input','required', 'placeholder'=>"何をつぶやこうか...?"]) }}
{{ Form::submit('',['class'=>'post_submit']) }}
{!! Form::close() !!}

<section class="display_message">
    @foreach ($posts as $post)
        <div class="message_wrapper">
            <img class="message_image" src="images/{{ $post -> image }}">
            <div class="message_box">
                <p class="message_username">{{ $post -> username }}</p>
                <p class="message_created">{{ date("Y/m/d H:i",strtotime($post -> created_at))}}</p>
                <div class="message_text">
                    <p class="message">{{ $post -> post }}</p>
                    <a><img class="button" src="images/edit.png"></a>
                    <a><img class="button" src="images/trash_h.png"></a>
                </div>
            </div>
        </div>
      @endforeach
</section>

@endsection
