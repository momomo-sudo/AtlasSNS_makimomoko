<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Route;
//ログインしているユーザーのみアクセスできるルートの設定（auth ミドルウェアが適用されたルートグループ内のすべてのルートは、ログイン済みのユーザーのみがアクセス可能になる）
Route::middleware(['auth'])->group(function () {
    // トップページ
    Route::get('/top', 'HomeController@index')->name('home');
    // プロフィール編集ページ
    Route::get('/profile', 'UsersController@profile');
    Route::post('/profile', 'UsersController@update')->name('profile.update');
    // ユーザー検索ページ
    Route::get('/search', 'UsersController@search')->name('users.search');
    // フォローリストページ
    Route::get('/follow-list', 'FollowsController@followList');
    Route::post('/follow-list/{userId}', 'FollowsController@store');
    // フォロワーリストページ
    Route::get('/follower-list', 'FollowsController@followerList');
    Route::post('/follow/{userId}/destroy', 'FollowsController::class@destroy');
    // 相手ユーザーのプロフィールページ（ミドルウェアをやる）
    // Route::get('/user/{id}', 'UsersController@show')->name('user.profile');
});

//ルーティングの基本構文
// Route::①('②', '③');
// ①HTTP上の通信方法(POST,GET)

// ②どのURLで表示するか(第1引数)

// ③どのメソッド(または関数)とつなげるか

Route::get('/', function () {
    return view('welcome');
});
Route::get('/top', 'HomeController@index')->name('home');//ルーティングをhomeと名付けている

Auth::routes();

//getは表示するためのもの、ログインする時の処理はPOST
//検索はGETでもPOSTでもできる（登録はしないから）

//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');//getはログインページを表示するだけの処理。だから、LoginController.phpのlogoutメソッドから繋がれた。(ここがゴール)
Route::post('/login', 'Auth\LoginController@login');//postは実際にmailとpasswordを入力してログインをする処理

Route::get('/register', 'Auth\RegisterController@register'); ///registerリンクにアクセスしたらRegisterControllerのregisterメソッドを呼び出す
Route::post('/register', 'Auth\RegisterController@register'); //登録処理をするからPOST

//ログアウトする時
Route::get('/logout', 'Auth\LoginController@logout');


Route::get('/added', 'Auth\RegisterController@added');

//ログイン中のページ、投稿ページ
Route::get('/top', 'PostsController@index')->name('posts.index');

//プロフィールページへのリンク
Route::get('/profile', 'UsersController@profile');//login.bladeから来た処理をControllerのprofileメソッドに繋げている
Route::post('/profile', 'UsersController@update')->name('profile.update');

//ユーザー検索
Route::get('/search', 'UsersController@search')->name('users.search'); ////login.bladeから来た処理をControllerのsearchメソッドに繋げている
Route::get('/users', 'UsersController@index');


//フォローリストのリンク
Route::get('/follow-list', 'FollowsController@followList');//login.blade.phpから来た処理をControllerのindexメソッドに繋げる
Route::get('/follower-list', 'FollowsController@followerList');
//フォローボタン
Route::post('/users/follow', 'UsersController@follow')->name('users.follow');
//フォローリスト表示
Route::get('/follow-list', 'UsersController@followedIcons')->name('follows.followList');


//投稿を押した時(処理をしているからPOST)
Route::post('/posts', 'PostsController@store')->name('post.store');

//編集ボタンを押した時のルート
Route::get('/edit/{id}', 'PostsController@edit')->name('post.edit');

//削除ボタンを押した時のルート
Route::get('/delete/{id}', 'PostsController@delete')->name('post.delete');

// 投稿の編集の更新処理
Route::post('/update/{id}', 'PostsController@update')->name('post.update');


//ルーティングの基本構文
// Route::①('②', '③');
// ①HTTP上の通信方法(POST,GET)

// ②どのURLで表示するか(第1引数)

// ③どのメソッド(または関数)とつなげるか
