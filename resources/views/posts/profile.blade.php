@extends('layouts.login')
@section('content')


{!! Form::open(["url" => "update-profile", "enctype" => "multipart/form-data"]) !!}
<div class="profile_wrapper">
    <div class="profile_info">
        <img class="profile_userface" src="{{$user -> image}}">
        <ul>
            <li class="{{$errors->has('username') ? 'has-error' : ''}}">
                <p class="profile_title">Name</p>
                {{ Form::text('username',$user -> username,['class' => 'profile_post','required']) }}
                @if ($errors->has('username'))
                    <p class="error">{{$errors->first('username')}}</p>
                @endif
            </li>
            <li class="{{$errors->has('mail') ? 'has-error' : ''}}">
                <p class="profile_title">MailAdress</p>
                {{ Form::text('mail',$user -> mail,['class' => 'profile_post','required']) }}
                @if ($errors->has('mail'))
                    <p class="error">{{$errors->first('mail')}}</p>
                @endif
            </li>
            <li class="{{$errors->has('new_password') ? 'has-error' : ''}}">
                <p class="profile_title">New Password</p>
                {{ Form::hidden('password',$user -> password) }}
                {{ Form::password('new_password',['class' => 'profile_post']) }}
                @if ($errors->has('new_password'))
                    <p class="error">{{$errors->first('new_password')}}</p>
                @endif
            </li>
            <li class="{{$errors->has('bio') ? 'has-error' : ''}}">
                <p class="profile_title">Bio</p>
                {{ Form::textarea('bio',$user -> bio,['class' => 'profile_post']) }}
                @if ($errors->has('bio'))
                    <p class="error">{{$errors->first('bio')}}</p>
                @endif
            </li>
            <li class="{{$errors->has('image') ? 'has-error' : ''}}">
                <p class="profile_title">Icon Image</p>
                <img id="preview">
                <p class="profile_post_imgname">選択されていません</p>
                <label class="profile_post_img">
                    {{ Form::file('image',['id'=>'file']) }}ファイルを選択
                </label>
                @if ($errors->has('image'))
                    <p class="error">{{$errors->first('image')}}</p>
                @endif
            </li>
            {{ Form::submit('更新',['class' => 'profile_update_button']) }}
        </ul>
    </div>
</div>
{!! Form::close() !!}

@endsection
