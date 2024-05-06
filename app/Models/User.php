<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    public $timestamps = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ログイン中の保育園の生徒一覧
    public function allStudent() 
    {
        // ログイン中の保育園IDを定義
        $user = \Auth::user();
        $nursery_id = $user->nursery_id;

        // 保育園絞る
        $students = User::join('nurseries', 'users.nursery_id', '=', 'nurseries.id')
        ->join('grades', 'users.class_id', '=', 'grades.id')
        // ログイン中の保育園IDに絞る
        ->where('users.nursery_id', '=', $nursery_id)
        //　生徒に絞る
        ->where('users.role', '=', '2')
        ->select('grades.years','grades.name as classname','users.name as studentname')
        // 年齢順.名前順にソート
        ->orderBy('grades.years', 'asc')
        ->orderBy('users.name')
        ->get();
        return $students;
    }




}
