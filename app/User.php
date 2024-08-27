<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'mail',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];



    //リレーション定義
    //return $this->belongsToMany(第一引数→関連するモデルのクラス名(
    //第二引数→中間テーブルの名前, 第三引数→中間テーブルにおける呼び出し元モデルの外部キー名);


    //「１対多」の「多」側 → メソッド名は複数形。
    public function posts()
    {
        return $this->hasMany('App\Post'); //belongsToは１対多の時、hasManyと使う
        //↑かっこの中は繋げたいリレーション先
    }

    // リレーション（同一テーブルでの多対多）
    public function followers()
    {
        return $this->belongsToMany(User::class, "follows", "followed_id", "following_id");
    }
    public function follows()
    {
        return $this->belongsToMany(User::class, "follows", "following_id", "followed_id");
    }

    //ログインユーザーは、対象ユーザーをフォローしているか？
    public function isFollow()
    {
        $id = $this->id;
        $isFollow = (boolean) Auth::user()->follows()->where('followed_id', $id)->first();

        return $isFollow;
    }

    //フォローリストのリレーション
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

}
