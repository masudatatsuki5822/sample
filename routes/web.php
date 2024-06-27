<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NurseryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LetterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//ゲスト(認証されてない人)
Route::middleware(['guest'])->group(function () {
    //ログイン画面の表示
    Route::get('/', [AuthController::class,'login_show'])->name('login_show');
    //ログインボタンを押したとき
    Route::post('/login', [AuthController::class,'login'])->name('login');
    //新規登録画面
    Route::get('/signup', [AuthController::class,'signup'])->name('signup');
    //新規登録で入力された値をUserテーブルに入れる
    Route::post('/register', [AuthController::class,'register'])->name('register');
});

//認証済み
Route::group(['middleware' => ['auth']], function () {
    //マイページ
    Route::get('/index',[NurseryController::class,'index'])->name('index');
    //ログアウト押したとき
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
    //お便り一覧
    Route::get('/letter/all',[LetterController::class,'letter_show'])->name('letter_show');
    //お便り詳細表示
    Route::get('/letter/all/{id}',[LetterController::class,'letter_detail'])->name('letter_detail');
});


//生徒側
Route::group(['middleware' => 'can:student'], function () {
    //連絡帳投稿画面表示
    Route::get('/contact/write',[ContactController::class,'contact_write'])->name('contact_write');
    //連絡帳投稿
    Route::post('/contact/send',[ContactController::class,'contact_send'])->name('contact_send');
    //連絡帳表示
    Route::get('/contact/show_one',[ContactController::class,'contact_show_one'])->name('contact_show_one');
    //連絡帳表示
    Route::get('/contact/show_one/before',[ContactController::class,'contact_show_before'])->name('contact_show_before');
});

//保育園側
Route::group(['middleware' => 'can:nursery'], function () {
    //クラス一覧画面表示
    Route::get('/class/all',[NurseryController::class,'class_show'])->name('class_show');
    //クラス新規登録画面表示
    Route::get('/class/add',[NurseryController::class,'class_add_show'])->name('class_add_show');
    //クラス新規登録ボタンを押したとき
    Route::post('/class/add_done',[NurseryController::class,'class_add'])->name('class_add');

    //生徒一覧表示
    Route::get('/student/all',[NurseryController::class,'student_show'])->name('student_show');
    //生徒新規登録画面表示
    Route::get('/student/add',[NurseryController::class,'student_add_show'])->name('student_add_show');
    //生徒新規登録ボタン押したとき
    Route::post('/student/add_done',[NurseryController::class,'student_add'])->name('student_add');

    //お便り投稿画面表示
    Route::get('/letter/write',[LetterController::class,'letter_write_show'])->name('letter_write_show');
    //お便り投稿ボタン押したとき
    Route::post('/letter/write_done',[LetterController::class,'letter_write'])->name('letter_write');
    //お便り編集画面表示
    Route::get('/letter/edit/{id}',[LetterController::class,'letter_edit'])->name('letter_edit');
    //お便り編集ボタン押したとき
    Route::post('/letter/update',[LetterController::class,'letter_update'])->name('letter_update');
    //お便り削除ボタン押したとき
    Route::post('/letter/delete/{id}',[LetterController::class,'letter_delete'])->name('letter_delete');

    //連絡帳クラス選択表示
    Route::get('/contact/class/show',[ContactController::class,'contact_classShow'])->name('contact_classShow');
    //選択したクラスの生徒を取得
    Route::post('/contact/student/select',[ContactController::class,'contact_student_select'])->name('contact_student_select');
    //選択したクラスの生徒を表示
    Route::get('/contact/student',[ContactController::class,'contact_student'])->name('contact_student');
    //選択した生徒の連絡帳表示
    Route::get('/contact/show/{id}',[ContactController::class,'contact_show'])->name('contact_show');
    //選択した生徒の連絡帳表示
    Route::get('/contact/show/before/{id}',[ContactController::class,'contact_show_all'])->name('contact_show_all');
    //確認しましたボタン押下げ時
    Route::post('/contact/student/',[ContactController::class,'contact_student_select'])->name('contact_student_select');
});


//管理者側
Route::group(['middleware' => 'can:admin'], function () {
    //ユーザー一覧を表示
    Route::get('/user/all',[NurseryController::class,'user_show'])->name('user_show');
    //ユーザー削除
    Route::post('/user/delete/{id}',[NurseryController::class,'user_delete'])->name('user_delete');
});




















