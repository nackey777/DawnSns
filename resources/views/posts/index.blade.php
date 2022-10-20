@extends('layouts.login')
@section('content')

<section class="post_message">
    {!! Form::open(["url" => "post"]) !!}
        <img class="post_face" src="{{$user->image}}">
        {{ Form::hidden('user_id',Auth::id())}}
        {{ Form::textarea('post',null,['class'=>'post_input','required', 'placeholder'=>"何をつぶやこうか...?"]) }}
        {{ Form::submit('',['class'=>'post_submit']) }}
    {!! Form::close() !!}
</section>

<section class="display_message">
    @foreach ($posts as $post)
        <div class="message_wrapper">
            <img class="message_image" src="{{ $post -> image }}">
            <div class="message_box">
                <p class="message_username">{{ $post -> username }}</p>
                <p class="message_created">{{ date("Y/m/d H:i",strtotime($post -> created_at))}}</p>
                <div class="message_text">
                    <p class="message">{!! nl2br(e($post -> post)) !!}</p>
                        @if($post -> user_id == Auth::id())
                            <a class="on_modal" data-id="{{ $post -> id }}"><img class="edit_image" src="images/edit.png"></a>
                            <div class="trash_container">
                                <a>
                                    <img class="trash_image" src="images/trash.png">
                                    <img class="trash_image" src="images/trash_h.png">
                                </a>
                            </div>
                        @endif
                </div>
            </div>
        </div>
      @endforeach
</section>

<section id="modal" style="display: none;">
    <a class="overlay off_modal"></a>
    <div class="modal_wrapper">
        <div class="modal-contents">
            <a class="modal-close off_modal">✕</a>
            <div class="modal-content">
                {!! Form::open(["url" => "update-post"]) !!}
                    {{ Form::hidden('id',null,['id'=>'update_postid'])}}
                    {{ Form::textarea('post',null,['id'=>'update_post','class'=>'update_post','required']) }}
                    <div class="right">
                        {{ Form::submit('',['class'=>'update_post_submit']) }}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>

@endsection

<script>
    window.addEventListener("load", function() {
        @if ($errors->any())
            alert("{{ implode('\n', $errors->all()) }}");
        @endif
    });
</script>
