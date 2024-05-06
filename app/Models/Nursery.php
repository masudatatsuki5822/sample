<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Nursery extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'mail', 'tel', 'password', 'role'
    ];
    public $timestamps = false;

    //ログイン中の保育園名を取得
    public function nurseryName() 
    {
        // ログイン中の保育園IDを定義
        $user = \Auth::user();
        $nursery_id = $user->nursery_id;

        $nursery = Nursery::join('users','nurseries.id','=','users.nursery_id')
        // ログイン中の保育園IDに絞る
        ->where('users.nursery_id', '=', $nursery_id)
        ->where('users.role', '=', '1')
        ->select('nurseries.name')
        ->get();
        //dd($nursery_name);
        return $nursery;
    }
}
