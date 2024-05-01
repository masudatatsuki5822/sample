<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Nursery;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


//保育園側のログイン認証
class AuthController extends Controller

{
    //ログイン画面の表示
    public function login_show() 
    {
        return view('account/login');
    }

    //新規登録画面の表示
    public function signup() 
    {
        return view('account/signup');
    }

    //バリデーションした内容を新規登録
    public function register(SignupRequest $request) 
    {
        $inputs = $request->all();
        // dd($inputs);
        \DB::beginTransaction();
        try {
            //保育園テーブルの登録
            $nursery = new Nursery();
            $nursery->name = $inputs['name'];
            $nursery->boss = $inputs['boss'];
            $nursery->mail = $inputs['mail'];
            $nursery->tel = $inputs['tel'];
            $nursery->password = bcrypt($inputs['password']);
            //dd($inputs);
            $nursery->save();

            //保存した保育園IDを定義
            $nurseryId = $nursery->id;

            //Usersテーブルの登録
            $user = new User();
            $user->name = $inputs['boss'];
            $user->mail = $inputs['mail'];
            $user->password = bcrypt($inputs['password']);
            $user->tel = $inputs['tel'];
            //保育園側はrole=1
            $user->role = $inputs['role'];
            //保育園側はclass_id=0
            $user->class_id = $inputs['class_id'];
            $user->nursery_id =  $nurseryId;

            $user->save();
            \DB::commit();

        } catch(\Throwable $e) {
            \DB::rollBack();
            //dd($e->getMessage());
        } 
        return redirect()->route('login_show');
    }

    //ログイン機能
    public function login (LoginRequest $request) 
    {
        //Usersテーブルにあるデータと同じならログインしメインページ表示
        //ログインに必要な情報を取得
        $credentials = $request->only('mail','password');

        if (Auth::attempt($credentials)) {
            // ユーザーのロールに応じてリダイレクト先を取得
            $redirectRoute = $this->getRedirectRoute(auth()->user()->role);
            //セッションの再生成
            $request->session()->regenerate();
            // リダイレクト
            return redirect()->route($redirectRoute);
        } else {
            return back()->withInput()->withErrors(['password' => '入力されたパスワードは登録されている内容と違います。']);
        }
    }
    //ユーザーのロールに応じてリダイレクト先を取得
    private function getRedirectRoute($role)
    {
        switch ($role) {
            case '1':
            case '2':
                return 'index'; // 保育園または生徒のマイページのルート
            default:
                return 'login_show'; // その他はログインページ表示
        }
    }
    //ログアウト機能
    public function logout(Request $request) 
    {
        Auth::logout();
        //セッションの無効化
        $request->session()->invalidate();
        //セッションのCSRFトークンを再生成
        $request->session()->regenerateToken();
        return redirect()->route('login_show');
    }
}
