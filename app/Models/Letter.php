<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Letter extends Model
{
    use HasFactory;
    protected $guarded = [
        'id','created_at','updated_at'
    ];

    //リレーションシップの設定
    public function grades() 
    {
        return $this->belongsToMany(Grade::class)->withTimestamps();
    }

    //お便り詳細取得
    public function detailLetter($id) 
    {
        $letter = Letter::select('*')
        ->find($id);
        //dd($letter);
        return $letter;
    }

    //お便り編集
    public function letterUpdate(Request $request)
    {
        //編集内容すべてを取得
        $updateLetter = $request->all();
        //dd($updateLetter);
        //画像ファイルを取得
        $image = $request->file('image');

        \DB::beginTransaction(); 
        try {
            //該当のIDのデータを取得
            $beforeLetter = Letter::find($updateLetter['id']);

            //入力された内容と差分があれば更新
            $beforeLetter->fill([
                'title' => $updateLetter['title'],
                'body' => $updateLetter['body']
            ]);
            //以前の画像があり、編集で新しい画像を選択したとき
            if(isset($beforeLetter->image)) {
                //以前の画像は削除
                \Storage::disk('public')->delete('images/' . $beforeLetter->image);
            }
            //新しい画像が提供されたら保存する
            if ($image) {
                $path = $image->store('/public/images');
                // 画像の名前だけ保存
                $path = basename($path);
            } else {
                $path = null;
            }
            $beforeLetter->image = $path;
            $beforeLetter->save();

            // Gradeモデルから対応するクラスidを取得
            $grade = Grade::find($request->class_id); 
            // 中間テーブルにデータを挿入
            $beforeLetter->grades()->attach($grade); 
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollBack();
            //dd($e->getMessage());
        }
    }
}
