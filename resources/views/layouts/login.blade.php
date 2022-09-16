<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
        <h1><a href="/top"><img src="images/main_logo.png" class="main-logo"></a></h1>
            <div id="menu-toggle">
                <!-- <div id="user"> -->
                <p class="username">{{ Auth::user()->username }}さん<span class="down-arrow"></span></p>
                <!-- <div> -->
                <ul class="menu">
                    <li><a href="/top">ホーム</a></li>
                    <li><a href="/profile">プロフィール</a></li>
                    <li><a href="/logout">ログアウト</a></li>
                </ul>
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p  class="confirm-name">{{ Auth::user()->username }}さんの</p>
                <div>
                    <p class="confirm-title">フォロー数</p>
                    <p class="confirm-number">{{$follow_number}}名</p>
                </div>
                <p class="btn confirm-follow"><a href="">フォローリスト</a></p>
                <div>
                    <p class="confirm-title">フォロワー数</p>
                    <p class="confirm-number">{{$follower_number}}名</p>
                </div>
                <p class="btn confirm-follow"><a href="">フォロワーリスト</a></p>
            </div>
            <p class="btn confirm-search"><a href="">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>


<script>
    $(function() {
        $('#menu-toggle').click(function() {
            $(this).children(".menu").toggle();
        });
    });
</script>
