<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use App\Follow;
class FollowsController extends Controller
{
    //
    public function followList()
    {
        //ユーザーのアクセス制限
        if (Auth::check()) {
            $follows = Auth::user()->follows();
        } else {

            return redirect()->route('login');
        }
        // 現在ログインしているユーザーを取得
        $user = Auth::user();
        // フォローしているユーザーを eager load で取得
        $followed = $user->follows()->get();
        // フォローしているユーザーの投稿を取得
        $posts = Post::query()->whereIn('user_id', $user->follows()->pluck('followed_id'))->latest()->get();
        // ビューにフォローしているユーザー情報を渡す
        return view('follows.followList', compact('followed', 'posts'));//followsフォルダ内のfollowList.blade.phpに繋げる
        //view('フォルダ名.ファイル名', 使いたい配列)

    }
    public function followerList()
    {
        //アクセス制限
        if (Auth::check()) {
            $follows = Auth::user()->follows();
        } else {
            //もしユーザーデータが存在しない場合、ログインページにリダイレクトする
            return redirect()->route('login');
        }


        $user = Auth::user();
        $followers = $user->followers()->get();//userモデルのfollowersメソッド
        // フォローされているユーザーの投稿を取得
        $posts = Post::query()->whereIn('user_id', $user->followers()->pluck('following_id'))->latest()->get();
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

    public function show($id, Follow $follower)
    {
        $user = User::find($id); // ページを表示する対象のユーザーを取得
        $users = $user->follows()->with('posts')->get();
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);
        // dd($user);
        // フォローしているユーザーのリストを取得
        if (!$user) {//もしユーザーデータが存在しない場合、ログインページにリダイレクトする
            return redirect()->route('login');
        }

        $followers = $user->followers()->get();//userモデルのfollowersメソッド

        $posts = Post::query()->whereIn('user_id', $user)->latest()->get(); //latest→作成日時(created_at)の最新順で表示
        return view('users.usersProfile', [
            'followers' => $followers,
            'user' => $user,
            'users' => $users,
            'posts' => $posts,
            // フォローしているユーザーのリストをビューに渡す
            'follow_count' => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

}
