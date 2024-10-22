<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Follow;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    //共通の変数を定義できる
    public function register()//登録、認証。ビックバン
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() //初期化された後、地球、アプリ
    {
        View::composer('layouts.login', function ($view) {
            // $follow_count = Follow::getFollowCount(Auth::user()->id);
            $follow_count = Auth::user()->follows()->count(); //フォロー数カウント
            $follower_count = Auth::user()->followers()->count(); //フォロワー数カウント
            $view->with(compact('follow_count', 'follower_count'));
        });
        //
    }
}
