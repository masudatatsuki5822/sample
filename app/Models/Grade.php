<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','years','teacher'
    ];
    //public $timestamps = false;

     //リレーションシップの設定
    public function letters() 
    {
        return $this->belongsToMany(Letter::class)->withTimestamps();
    }

    //保育園のクラス一覧
    public function allGrade() 
    {
        //ログイン中の保育園のIDを定義
        $user = \Auth::user();
        $nursery_id = $user->nursery_id;

        $grades = Grade::select('id','name','years','teacher')
        ->where('nursery_id', '=', $nursery_id)
        ->get();
        //dd($grades);
        return $grades;
    }

    //生徒登録時のクラスの選択用(ログイン中の保育園のクラス名とidを取得)
    public function className() 
    {
        //ログイン中の保育園のIDを定義
        $user = \Auth::user();
        $nursery_id = $user->nursery_id;

        $classes = Grade::select('id','name')
        ->where('nursery_id', '=', $nursery_id)
        ->get();
        //dd($classes);
        return $classes;
    }

}
