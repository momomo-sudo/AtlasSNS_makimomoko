<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
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
    <!-- ヘッダーエリア -->
    <header>
        <div id="head">
            <a href="{{ URL::to('/top') }}"> <!-- ページの最上部へのリンク -->
                <img src="{{ asset('/images/atlas.png') }}" alt="Atlas" class="atlas"> <!-- 画像と画像の代わりのテキスト。assetは Laravelの画像の呼び出し -->
            </a>

            <div class="side_user">
                <p>{{ Auth::user()->username }}<span class="suffix">さん</span></p>

                <!-- imagesフォルダ内のユーザーの画像を表示する -->
                <!-- asset→グローバルヘルパー関数。publicディレクトリ内にあるファイルへのURLを生成する。アセット（画像、CSS、JavaScriptファイルなど）のURLを生成するために使われる。
                         /images/icon1.png→publicディレクトリ内のimagesフォルダにあるicon1.pngという画像ファイルのパス-->

                <!-- アコーディオンメニュー -->
                <nav class="menu-box">
                    <button type="button" id="menu_btn" class="menu_btn"></button>
                    <ul class="menu"><!-- 今回消したり表示したいのはここ-->
                        <li><a class="home" href="{{ URL::to('/top') }}">ホーム</a></li>
                        <!-- ここがスタート、web.phpに繋げる -->
                        <li><a class="profile" href="{{ URL::to('/profile') }}">プロフィール</a></li>
                        <!-- ここがスタート -->
                        <li><a class="center" href="{{ URL::to('/logout') }}">ログアウト</a></li>
                        <!-- ここからスタートしてweb.phpに繋げている -->
                    </ul>
                </nav>
                <!-- アイコン -->
                <img src="{{ asset('storage/images/' . Auth::user()->images) }}" width="50" height="50">
            </div>
        </div>
    </header>

    <!-- 投稿エリア -->
    <div id="row">
        @yield('content')


        <!-- サイドエリア -->
        <div id="side-bar">
            <div class="side-follow">
                <p>{{ Auth::user()->username }}さんの</p>
                <div class="follow-count">
                    <p>フォロー数</p>
                    <p><span>{{ $follow_count }}</span>名</p>
                </div>
                <p><a href="{{ URL::to('/follow-list') }}" class="btn-follow">フォローリスト</a></p>
                <!-- ここからweb.phpに繋げる -->
                <div class="follower-count">
                    <p>フォロワー数</p>
                    <p><span>{{ $follower_count }}</span>名</p>
                </div>
                <p><a href="{{ URL::to('/follower-list') }}" class="btn-follower">フォロワーリスト</a></p>
            </div>
            <p><a href="{{ URL::to('/search') }}" class="search-btn">ユーザー検索</a></p>
        </div>
    </div>


    <!-- Javascript・jQueryのファイルリンク -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
    <script>
        function follow(userId) {
            $.ajax({
                // これがないと419エラーが出ます
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                url: `/follow/${userId}`,
                type: "POST",
            })
                .done(data => {
                    console.log(data)
                })
                .fail(data => {
                    console.log(data)
                })
        }
    </script>
</body>
</html>
