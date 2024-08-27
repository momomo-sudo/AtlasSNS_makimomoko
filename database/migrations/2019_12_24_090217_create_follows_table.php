<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //upメソッド→マイグレーションを実行する時の処理
    {
        Schema::create('follows', function (Blueprint $table) { //followsテーブル（中間）
            //Schema::create は第一引数に指定した名称(follows)のテーブルを作成するためのプロシージャで、実際に作るテーブルのカラム定義などは第二引数の function の中に記述する
            $table->integer('id')->autoIncrement();
            $table->integer('following_id'); //整数型(int)、中間テーブルID？
            $table->integer('followed_id');
            $table->timestamp('created_at')->useCurrent(); //タイムスタンプ型
            $table->timestamp('updated_at')->default(DB::raw('current_timestamp on update current_timestamp'));
            $table->foreignId('user_id')->constrained()->onDelete('cascade');//外部のテーブル（usersテーブル）のidカラムを参照する外部キー
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //downメソッド→マイグレーションをロールバックする時、テーブルを削除するために実行される処理
    {
        Schema::dropIfExists('follows');
    }
}
