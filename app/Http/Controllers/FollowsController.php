<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    //
    public function followList()
    {
        return view('follows.followList'); //followsフォルダ内のfollowList.blade.phpに繋げる
    }
    public function followerList()
    {
        return view('follows.followerList'); //followsフォルダ内のfollowerList.blade.phpに繋げる
    }
}
