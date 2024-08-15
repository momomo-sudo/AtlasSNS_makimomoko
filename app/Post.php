<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [ //PostControllerとのやりとりにつながっている
        //データベース（atlas_sns）→テーブル→カラム（縦）→レコード（横）→フィールド（1個1個の粒）
        'user_id',
        'post'
    ];


    //リレーション定義を追加
    //「１対多」の「多」側 → メソッド名は複数形。
    public function user() //１対多の「１」だから、単数系
    {
        return $this->belongsTo('App\User'); //hasManyは１対多の時使う
        //↑かっこの中は繋げたいリレーション先
        //カッコの中が多だったらhasmany
    }
}
