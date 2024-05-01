<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NurseryController;
use App\Http\Controllers\StudentsController;
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
    //ログアウト押したとき
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
    //お便り一覧
    Route::get('/letter/all',[LetterController::class,'letter_show'])->name('letter_show');
    //マイページ
    Route::get('/index',[NurseryController::class,'index'])->name('index');
});

//生徒側
Route::group(['middleware' => 'can:student'], function () {


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
    //お便り詳細表示
    Route::get('/letter/all/{id}',[LetterController::class,'letter_detail'])->name('letter_detail');
    //お便り編集画面表示
    Route::get('/letter/edit/{id}',[LetterController::class,'letter_edit'])->name('letter_edit');
    //お便り編集ボタン押したとき
    Route::post('/letter/update',[LetterController::class,'letter_update'])->name('letter_update');
    //お便り削除ボタン押したとき
    Route::post('/letter/delete/{id}',[LetterController::class,'letter_delete'])->name('letter_delete');
});

//管理者側
// Route::group(['middleware' => 'can:admin'], function () {

// });




