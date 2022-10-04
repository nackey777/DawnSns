@extends('layouts.login')
@section('content')

<h2 class="list_title">Follow List</h2>

<section class="follow_list_section">
    <div class="follow_list">
        @if($datas->isEmpty())
            <p>フォローしているユーザーはいません</p>
        @else
            @foreach ($datas as $data)
                <a href="/profile/{{ $data -> follower_id }}">
                    <img class="follow_image" src="images/{{ $data -> image }}">
                </a>
            @endforeach
        @endif
    </div>
</section>

<section class="display_message">
    @foreach ($posts as $post)
        <div class="message_wrapper">
            <a href="/profile/{{ $post -> user_id }}">
                <img class="message_image" src="images/{{ $post -> image }}">
            </a>
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
