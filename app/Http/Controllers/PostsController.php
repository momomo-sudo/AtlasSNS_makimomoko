<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; //Http内にあるRequestモデル内のRequestクラスを使用しますっていう意味。
//app直下にilluminateってファイルがないからどこ？てなる
//vendor\laravel\framework\src\illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Post; //MVCのモデルをインポート



class PostsController extends Controller
{
    protected $post; // プロパティを定義f
    public function __construct(Post $post)
    {
        $this->post = $post; // Postモデルを依存性注入で取得
    }

    public function index()///topを表示させているメソッド→index
    {
        $user = Auth::user();
        if (!$user) {//もしユーザーデータが存在しない場合、ログインページにリダイレクトする
            return redirect()->route('login');
        }
        $posts = Post::get();//Postモデル（postsテーブル）からレコード情報を取得
        $user_id = Auth::id();

        return view('posts.index', ['posts' => $posts, 'user_id' => $user_id]); //viewフォルダ内の、postsはフォルダ内のindex.blade.phpに繋げている。
    }

    /**投稿機能**/
    public function store(Request $request) //Requestクラス
    {
        $request->validate([
            'post' => 'required|max:150',
        ]);
        $user_id = Auth::user()->id;  //Auth::userだと、ログインしている人の情報を全部出してくれ
        $post = $request->input('content');

        //created_atと、updated_atは自動で入力される。

        // $itou = Auth::user();
        // dd($itou);//ddはカッコの中になんの値が入っているかをみる。カッコの中身を見せてくれる

        Post::create(['user_id' => $user_id, 'post' => $post,]);

        return redirect('/top'); // 投稿一覧ページにリダイレクト
    }


    /** 編集画面の表示*/
    public function edit($id)//ルーティングで記述した「{id}」とメソッドの引数においた「$id」のように、名前を同じにしておく必要がある
    {
        //$postは、メソッド内で使用される変数で、指定されたIDに対応するPostモデルのインスタンス（データベースのレコード・設計図（クラス））を格納します。
        $post = Post::find($id);//user_idに基づくレコード1件を取得している。
        return view('posts.edit', compact('post'));
    }

    /**更新処理*/
    public function update(Request $request)
    {
        // バリデーション
        $request->validate([
            'upPost' => 'required|string|max:150',
            'post_id' => 'required|integer|exists:posts,id',
        ]);

        $id = $request->input('post_id');// フォームから送信された投稿IDを取得
        $up_post = $request->input('upPost');// フォームから送信された新しい投稿内容を取得
        // 指定されたIDの投稿を更新
        Post::where('id', $id)->update(['post' => $up_post]);

        return redirect('/top');
    }




    //削除機能の実装
    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect('/top');
    }

}
