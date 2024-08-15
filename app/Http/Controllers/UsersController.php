<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    //
    public function profile() //web.phpから来た処理をusersフォルダ内のprofile.bladeに繋げている。
    {
        return view('users.profile'); //
    }

    public function search(Request $request)//web.phpから来た処理をusersフォルダ内のsearch.bladeに繋げている。
    {
        // リクエストから検索クエリを取得
        $query = $request->input('query');
        // dd($query);
        // 検索クエリが指定されている場合
        if ($query) {
            // ユーザー名が部分一致するユーザーを検索
            $users = User::where('username', 'LIKE', "%{$query}%")
                ->get();
            // Post::create(['user_id' => $user_id, 'post' => $post]);
        } else {
            // 検索クエリが指定されていない場合は全ユーザーを取得
            $users = User::all();//この中だと、bladeでは使えない
        }

        // 検索結果をビューに渡す


        return view('users.search', ['users' => $users, 'query' => $query]);
    }
}
