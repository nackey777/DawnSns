@extends('layouts.login')
@section('content')

<section class="profile">
    <div class="profile_wrapper">
        <div class="profile_info">
            <img class="profile_userface" src="{{$user -> image}}">
            <ul>
                <li>
                    <p class="profile_title">Name</p>
                    <p class="profile_text">{{$user -> username}}</p>
                </li>
                <li>
                    <p class="profile_title">Bio</p>
                    <p class="profile_text">{{$user -> bio}}</p>
                </li>
            </ul>
        </div>

        @if($is_follow == true)
            <p class="btn unfollow_button">
                <a href="/unfollow/?follow_id={{Auth::id()}}&follower_id={{ $user -> id }}">フォローをはずす</a>
            </p>
        @else
            <p class="btn follow_button">
                <a href="/follow/?follow_id={{Auth::id()}}&follower_id={{ $user -> id }}">フォローする</a>
            </p>
        @endif
    </div>
</section>

<section class="display_message">
    @foreach ($posts as $post)
        <div class="message_wrapper">
            <a href="/profile/{{ $post -> user_id }}">
                <img class="message_image" src="{{$user -> image}}">
            </a>
            <div class="message_box">
                <p class="message_username">{{ $user -> username }}</p>
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
