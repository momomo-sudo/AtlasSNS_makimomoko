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

        //9/11追加
        $followed = $user->follows()->pluck('followed_id');
        $followed->push($user->id); //自分の投稿を表示させるように追加
        // フォローしているユーザーの投稿を取得
        $posts = Post::query()->whereIn('user_id', $followed)->latest()->get();
        return view('posts.index', ['posts' => $posts, 'user_id' => $user_id, 'user' => $user,]); //viewフォルダ内の、postsはフォルダ内のindex.blade.phpに繋げている。
    }

    /**投稿機能**/
    public function store(Request $request) //Requestクラス
    {
        //バリデーション
        $request->validate([
            'content' => 'required|max:150',
        ], [
            'content.required' => '投稿内容は必ず指定してください。',
        ]);

        $user_id = Auth::user()->id;  //Auth::userだと、ログインしている人の情報を全部出してくれ
        $post = $request->input('content');

        //created_atと、updated_atは自動で入力される。

        // $itou = Auth::user();
        // dd($itou);//ddはカッコの中になんの値が入っているかをみる。カッコの中身を見せてくれる

        Post::create(['user_id' => $user_id, 'post' => $post,]);  // 新しい投稿を作成して保存

        return redirect('/top'); // 投稿一覧ページにリダイレクト
    }


    /** 編集画面の表示*/
    public function update(Request $request, $id)
    {

        // バリデーション
        $request->validate([
            'post' => 'required|string|max:150',
        ], [
            'post.max' => '編集内容は必ず150文字以下にしてください。',
        ]);

        // IDから該当する投稿を取得
        $post = Post::find($id);

        // 投稿内容を更新
        $post->post = $request->input('post');

        // 投稿を保存
        $post->save();

        // リダイレクトもしくはレスポンス
        return redirect('/top');
    }




    //削除機能の実装
    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect('/top');
    }

}
