<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; //Http内にあるRequestモデル内のRequestクラスを使用しますっていう意味。
//app直下にilluminateってファイルがないからどこ？てなる
//vendor\laravel\framework\src\illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Post; //MVCのモデルの場所



class PostsController extends Controller
{

    public function index()///topを表示させているメソッド→index
    {
        $posts = Post::get();//Postモデル（postsテーブル）からレコード情報を取得
        return view('posts.index', ['posts' => $posts]); //viewフォルダ内の、postsはフォルダ内のindex.blade.phpに繋げている。
    }

    public function store(Request $request) //Requestクラス
    {
        $user_id = Auth::user()->id;  //Auth::userだと、ログインしている人の情報を全部出してくれ
        $post = $request->input('content');
        //created_atと、updated_atは自動で入力される。

        // $itou = Auth::user();
        // dd($itou);//ddはカッコの中になんの値が入っているかをみる。カッコの中身を見せてくれる

        Post::create(['user_id' => $user_id, 'post' => $post]);

        return redirect('/top'); // 投稿一覧ページにリダイレクト
    }


    /** 編集画面の表示*/
    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit', compact('post'));
    }

    //削除機能の実装
    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect('/top');
    }
}
