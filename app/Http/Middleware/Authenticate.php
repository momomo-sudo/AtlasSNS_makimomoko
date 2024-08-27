<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //ユーザーがログインしていない場合、ログインページへリダイレクトさせる。
        //ブラウザで「/profile」にアクセスしたとする。しかし、ログインしていない場合、expectsJson() は false になります。コードはログインページのURLを返して、ブラウザはログインページにリダイレクトされる
        if (!$request->expectsJson()) { //「このリクエストはJSON形式の応答を期待しているか？」を確認するもの
            return route('login');
        }
    }
}
