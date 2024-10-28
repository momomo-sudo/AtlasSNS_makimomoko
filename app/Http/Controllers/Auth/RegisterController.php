<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {

        if ($request->isMethod('post')) {//isMethod() 引数に指定した文字列とHTTP動詞が一致するかを判定する、一致すればtrueが、しなければfalseが返る

            // バリデーション
            $request->validate([
                'username' => 'required|max:12|min:2',
                'mail' => 'required|email|max:40|min:5|unique:users,mail',
                'password' => 'required|alpha-num|max:20|min:8', //8文字以上、英数字等
                'password_confirmation' => 'required|alpha-num|max:20|min:8|same:password',
            ]);

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password), //暗号化している
            ]);

            //addad.bladeのセッションでユーザー名表示。
            //登録完了したユーザー名をセッションに保存する→保存したユーザー名をビューファイルへ表示する。
            $request->session()->put('username', $username);
            return redirect('added');
        }
        return view('auth.register');




    }

    public function added()
    {
        return view('auth.added');
    }
}
