<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GradeLetter extends Model
{
    use HasFactory;

    //テーブル名を指定
    protected $table = 'grade_letter';
    
    //お便り一覧の日付・タイトル・配信クラスを取得
    public function allLetter() 
    {
        // ログイン中の保育園IDを定義
        $user = \Auth::user();
        $nursery_id = $user->nursery_id;

        $allLetter = GradeLetter::join('letters','grade_letter.letter_id','=','letters.id')
        ->join('grades','grade_letter.grade_id','=','grades.id')
        //ログイン中の保育園に絞る
        ->where('grades.nursery_id', '=', $nursery_id)
        ->select('letters.id','letters.title','letters.created_at',
        //クラス名をグループ化し文字列として連結
        DB::raw('GROUP_CONCAT(grades.name SEPARATOR ",") AS names'))
        ->groupBy('letters.id')
        ->orderBy('letters.created_at','desc')
        ->orderBy('names')
        ->get();



        return $allLetter;
    }
}
