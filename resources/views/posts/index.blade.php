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
                    <p class="message">{{ $post -> post }}</p>
                        @if($post -> user_id == Auth::id())
                            <a><img class="edit_image" src="images/edit.png"></a>
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

@endsection

<script>
    window.addEventListener("load", function() {
        @if ($errors->any())
            alert("{{ implode('\n', $errors->all()) }}");
        @endif
    });

</script>
