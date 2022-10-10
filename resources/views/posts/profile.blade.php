@extends('layouts.login')
@section('content')


{!! Form::open(["url" => "update-profile", "enctype" => "multipart/form-data"]) !!}
<div class="profile_wrapper">
    <div class="profile_info">
        <img class="profile_userface" src="{{$user -> image}}">
        <ul>
            <li>
                <p class="profile_title">Name</p>
                {{ Form::text('username',$user -> username,['class' => 'profile_post','required']) }}
                @if ($errors->has('username'))
                    <p class="error">{{$errors->first('username')}}</p>
                @endif
                <!-- <input type="text" class="profile_post" value="{{$user -> username}}"> -->
            </li>
            <li>
                <p class="profile_title">MailAdress</p>
                {{ Form::text('mail',$user -> mail,['class' => 'profile_post','required']) }}
                @if ($errors->has('mail'))
                    <p class="error">{{$errors->first('mail')}}</p>
                @endif
                <!-- <input type="text" class="profile_post" value="{{$user -> mail}}"> -->
            </li>
            <!-- <li>
                <p class="profile_title">Password</p>
                <input type="text" class="profile_post" value="{{$user -> password}}">
            </li> -->
            <li>
                <p class="profile_title">New Password</p>
                {{ Form::hidden('password',$user -> password) }}
                {{ Form::password('new_password',['class' => 'profile_post']) }}
                @if ($errors->has('new_password'))
                    <p class="error">{{$errors->first('new_password')}}</p>
                @endif
                <!-- <input type="text" class="profile_post"> -->
            </li>
            <li>
                <p class="profile_title">Bio</p>
                {{ Form::text('bio',$user -> bio,['class' => 'profile_post','required']) }}
                @if ($errors->has('bio'))
                    <p class="error">{{$errors->first('bio')}}</p>
                @endif
                <!-- <input type="text" class="profile_post" value="{{$user -> bio}}"> -->
            </li>
            <li>
                <p class="profile_title">Icon Image</p>
                <label class="profile_post_img">
                    {{ Form::file('image') }}ファイルを選択
                </label>
            </li>
            {{ Form::submit('更新',['class' => 'profile_update_button']) }}
        </ul>
    </div>
</div>
{!! Form::close() !!}

@endsection
