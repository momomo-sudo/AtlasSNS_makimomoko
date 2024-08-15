<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() // __constructメソッド→どのURLと繋げる？
    {
        $this->middleware('auth');//そのコントローラー内のすべてのアクションに対して認証を要求することができる。
        //認証されていないユーザーがアクセスを試みると、ログインページにリダイレクトされる
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //indexメソッド→どのURLと繋げる？postリクエスト？
    //リソースコントローラーのデフォルトのアクションとして使用され、リソースの一覧表示やホームページの表示に利用されます。
    {
        // 認証されたユーザーのみがアクセスできる
        return view('layouts.login');//layoutsフォルダ内のlogin.bladeに繋げる
    }
}
