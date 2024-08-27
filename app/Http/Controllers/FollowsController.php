<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
class FollowsController extends Controller
{
    //
    public function followList()
    {

        $user = Auth::user();
        if (!$user) {//もしユーザーデータが存在しない場合、ログインページにリダイレクトする
            return redirect()->route('login');
        }
        return view('follows.followList'); //followsフォルダ内のfollowList.blade.phpに繋げる

    }
    public function followerList()
    {
        $user = Auth::user();
        if (!$user) {//もしユーザーデータが存在しない場合、ログインページにリダイレクトする
            return redirect()->route('login');
        }
        return view('follows.followerList'); //followsフォルダ内のfollowerList.blade.phpに繋げる
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
