@extends('layouts.logout')

@section('content')

<div id="clear">

  <div class="message_hello">
    <p>{{$username}}さん、</p>
    <p>ようこそ！DAWNSNSへ！</p>
  </div>

  <div class="message_complete">
    <p>ユーザー登録が完了しました。</p>
    <p>さっそく、ログインをしてみましょう。</p>
  </div>

  <div class="pb30">
    <input class="button center" type="button" value="ログイン画面へ戻る" onclick="location.href='/login'">
  </div>
</div>

@endsection
