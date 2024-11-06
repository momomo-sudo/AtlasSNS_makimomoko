<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;

use App\Follow;


class UsersController extends Controller
{
    /***ユーザー登録機能**/
    public function profile() //web.phpから来た処理をusersフォルダ内のprofile.bladeに繋げている。
    {
        $user = Auth::user();
        if (!$user) {//もしユーザーデータが存在しない場合、ログインページにリダイレクトする
            return redirect()->route('login');
        }
        $posts = User::get();//Postモデル（postsテーブル）からレコード情報を取得

        return view('users.profile', ['posts' => $posts, 'user' => $user]);
    }

    /**プロフィール編集**/
    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|max:12|min:2',
            'mail' => 'required|email|max:40|min:5|unique:users,mail,' . Auth::user()->mail . ',mail',
            'password' => 'required|alpha-num|max:20|min:8', //8文字以上、英数字等
            'password_confirmation' => 'required|alpha-num|max:20|min:8|same:password',
            'bio' => 'nullable|max:150',
            'images' => 'nullable|image|mimes:jpg,png,bmp,gif,svg', // 画像ファイルのバリデーション
        ]);

        $user = Auth::user();
        $user->username = $request->input('username');
        $user->mail = $request->input('mail');
        $user->bio = $request->input('bio');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        if ($request->hasFile('images')) {
            // 画像ファイルがアップロードされている場合
            $image = $request->file('images');
            $imagePath = $image->store('public/images'); // 画像をストレージに保存
            $user->images = basename($imagePath); // ファイル名だけを保存
        }

        $user->save();

        return redirect()->route('profile.update')->with('success', 'プロフィールが更新されました。');
    }

    public function search(Request $request)//web.phpから来た処理をusersフォルダ内のsearch.bladeに繋げている。
    {
        //アクセス制限
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // リクエストから検索クエリを取得
        $username = $request->input('username');
        // dd($query);
        // 検索クエリが指定されている場合
        if ($username) {
            // ユーザー名が部分一致するユーザーを検索
            $users = User::where('username', 'LIKE', "%{$username}%")
                ->get();
            // Post::create(['user_id' => $user_id, 'post' => $post]);
        } else {
            // 検索クエリが指定されていない場合は全ユーザーを取得
            $users = User::all();//この中だと、bladeでは使えない
        }

        // 検索結果をビューに渡す


        return view('users.search', ['users' => $users, 'username' => $username]);
    }

    public function show($id, Follower $follower)
    {
        $user = User::find($id); // ページを表示する対象のユーザーを取得
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);
        // dd($user);
        // フォローしているユーザーのリストを取得
        if (!$user) {//もしユーザーデータが存在しない場合、ログインページにリダイレクトする
            return redirect()->route('login');
        }

        $posts = Post::query()->whereIn('user_id', $user)->latest()->get(); //latest→作成日時(created_at)の最新順で表示
        return view('users.usersProfile', [
            'user' => $user,
            'posts' => $posts,
            // フォローしているユーザーのリストをビューに渡す
            'follow_count' => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

    public function index()
    {
        $users = User::all();
        return view('users/search', compact('users'));//usersという名前の変数がビューに渡される

    }


    public function follow(Request $request)
    {
        $followed_id = $request->followed_id;
        $isFollow = (boolean) Follow::where('following_id', Auth::user()->id)->where('followed_id', $followed_id)->first();

        if ($isFollow) {
            $unfollow = Follow::where('following_id', Auth::user()->id)->where('followed_id', $followed_id);
            $unfollow->delete();
        } else {
            $follow = new follow();
            $follow->following_id = Auth::user()->id;
            $follow->followed_id = $followed_id;
            $follow->save();
        }

        return back();
    }

}
