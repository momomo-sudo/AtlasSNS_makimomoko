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
            <h1><a href="{{ URL::to('/top') }}"> <!-- ページの最上部へのリンク -->
            <img src="{{ asset('/images/atlas.png') }}" alt="Atlas"> <!-- 画像と画像の代わりのテキスト。assetは Laravelの画像の呼び出し -->
            </a>
        </h1>
            <div class="side_user">
                <p>{{ Auth::user()->username }} さん <img src="{{ asset('storage/images/' . Auth::user()->images) }}" width="50" height="50"></p>

                <!-- imagesフォルダ内のユーザーの画像を表示する -->
                <!-- asset→グローバルヘルパー関数。publicディレクトリ内にあるファイルへのURLを生成する。アセット（画像、CSS、JavaScriptファイルなど）のURLを生成するために使われる。
                         /images/icon1.png→publicディレクトリ内のimagesフォルダにあるicon1.pngという画像ファイルのパス-->

                <!-- アコーディオンメニュー -->
                <div class="menu-box">
                    <button type="button" id="menu_btn" class="menu_btn">メニューボタン（クリックして開閉）</button>
                    <ul class="menu"><!-- 今回消したり表示したいのはここ-->
                        <li><a class="home" href="{{ URL::to('/top') }}">ホーム</a></li>
                        <!-- ここがスタート、web.phpに繋げる -->
                        <li><a class="profile" href="{{ URL::to('/profile') }}">プロフィール</a></li>
                        <!-- ここがスタート -->
                        <li><a class="center" href="{{ URL::to('/logout') }}">ログアウト</a></li>
                        <!-- ここからスタートしてweb.phpに繋げている -->
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p>{{ Auth::user()->username }}さんの</p>
                <div>
                    <p>フォロー数</p>
                    <p>〇〇名</p>
                </div>
                <p class="btn-follow"><a href="{{ URL::to('/follow-list') }}">フォローリスト</a></p>
                <!-- ここからweb.phpに繋げる -->
                <div>
                    <p>フォロワー数</p>
                    <p>〇〇名</p>
                </div>
                <p class="btn-follower"><a href="{{ URL::to('/follower-list') }}">フォロワーリスト</a></p>
            </div>
            <p class="search"><a href="{{ URL::to('/search') }}">ユーザー検索</a></p>
        </div>
    </div>
    <!-- フッターエリア -->
    <footer>
    </footer>
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
