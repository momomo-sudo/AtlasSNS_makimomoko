<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = 'follows';

    // フォローしているユーザーを取得する
    public function followers()
    {
        return $this->belongsTo(User::class, "follows", "followed_id", "following_id");
    }

    // フォローされているユーザーを取得する
    public function follows()
    {
        return $this->belongsTo(User::class, "follows", "following_id", "followed_id");
    }
}
