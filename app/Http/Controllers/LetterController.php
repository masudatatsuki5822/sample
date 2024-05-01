<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LetterRequest;
use App\Models\Grade;
use App\Models\Letter;
use App\Models\GradeLetter; 


class LetterController extends Controller
{
    //お便り一覧表示
    public function letter_show()
    {
        $allLetterTable = new GradeLetter();
        $allLetters = $allLetterTable->allLetter();
        //dd($sendClasses);

        return view('letter/index',['allLetters'=>$allLetters]);
    }

    //お便り詳細表示
    public function letter_detail($id) 
    {
        $detailTable = new Letter();
        $one_letter = $detailTable->detailLetter($id);
        // dd($one_letter);
        return view('letter/read',['one_letter' => $one_letter]);
    }

    //お便り投稿画面表示
    public function letter_write_show()
    {
        $classesTable = new Grade;
        $classes = $classesTable->className();
        return view('letter/write',['classes'=>$classes]);
    }


    //お便り投稿ボタン押したとき
    public function letter_write(LetterRequest $request)
    {
        // ログイン中の保育園IDを定義
        $user = \Auth::user();
        $nursery_id = $user->nursery_id;
        //画像のファイルを定義
        $image = $request->file('image');

        \DB::beginTransaction(); 
        try {
            $letter = new Letter();
            $letter->nursery_id = $nursery_id;
            $letter->title = $request['title'];
            $letter->body = $request['body'];
            

            if ($image) {
                $path = $image->store('/public/images');
                // 画像の名前だけ保存
                $path = basename($path);
            } else {
                $path = null;
            }
            $letter->image = $path;
            $letter->save();
            
            $letter->image = $path;
            $letter->save();

            // Gradeモデルから対応するクラスidを取得
            $grade = Grade::find($request->class_id); 
            // 中間テーブルにデータを挿入
            $letter->grades()->attach($grade); 
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollBack();
            //dd($e->getMessage());
        }
        return redirect()->route('letter_show');
    }


    //編集画面
    public function letter_edit($id) 
    {
        //選択したお便りを取得
        $detailTable = new Letter();
        $one_letter = $detailTable->detailLetter($id);
        //クラス名を表示
        $classesTable = new Grade;
        $classes = $classesTable->className();

        return view('letter/edit',['one_letter' => $one_letter,'classes'=>$classes]);
    }

    //編集ボタン押したとき
    public function letter_update(Request $request) 
    {
        $updateTable = new Letter;
        $updateLetter = $updateTable->letterUpdate($request);
        return redirect()->route('letter_show');
    }

    //お便り削除する
    public function letter_delete($id) 
    {
        $deleteLetter = letter::find($id);
        $deleteLetter->delete();
        return redirect()->route('letter_show');
    }

}
