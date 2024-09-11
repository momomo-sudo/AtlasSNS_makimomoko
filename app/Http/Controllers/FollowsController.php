<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
class FollowsController extends Controller
{
    //
    public function followList()
    {
        // 現在ログインしているユーザーを取得
        $user = Auth::user();
        // フォローしているユーザーを eager load で取得
        $followed = $user->follows()->get();
        // フォローしているユーザーの投稿を取得
        $posts = Post::query()->whereIn('user_id', $user->follows()->pluck('followed_id'))->latest()->get();

        // デバッグ用にデータを確認
        if ($followed->isEmpty()) {
            return redirect()->route('login');
        }

        // ビューにフォローしているユーザー情報を渡す
        return view('follows.followList', compact('followed', 'posts'));//followsフォルダ内のfollowList.blade.phpに繋げる
        //view('フォルダ名.ファイル名', 使いたい配列)

    }
    public function followerList()
    {
        $user = Auth::user();
        $followers = $user->followers()->get();//userモデルのfollowersメソッド
        // フォローされているユーザーの投稿を取得
        $posts = Post::query()->whereIn('user_id', $user->followers()->pluck('following_id'))->latest()->get();
        if ($followers->isEmpty()) {//もしユーザーデータが存在しない場合、ログインページにリダイレクトする
            return redirect()->route('login');
        }
        return view('follows.followerList', compact('followers', 'posts')); //followsフォルダ内のfollowerList.blade.phpに繋げる
    }

    public function store($userId)
    {
        Auth::user()->follows()->attach($userId);
        return;
    }

    public function destroy($userId)
    {
        Auth::user()->follows()->detach($userId);
        return;
    }


    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }
}
