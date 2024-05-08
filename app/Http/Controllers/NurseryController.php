<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClassNameRequest;
use App\Http\Requests\StudentRequest;
use App\Models\Grade;
use App\Models\User;
use App\Models\Nursery;

class NurseryController extends Controller
{
    // システム管理者 ユーザー一覧画面表示
    public function user_show() 
    {
        $usersTable = new User;
        $users = $usersTable->getUser();

        return view('nursery/admin',['users' => $users]);
    }

    // ユーザー削除
    public function user_delete($id)
    {
        $deleteUser = User::find($id);
        $deleteUser->delete();
        return redirect()->route('user_show');
    }

    // 保育園マイページ
    public function index() 
    {
        // 保育園名を取得
        $nurseryTable = new Nursery;
        $nursery = $nurseryTable->nurseryName();
        //dd($nursery_name);

        // return view('nursery/index',['nursery' => $nursery]);
        return view('nursery/index');
    }

    // クラス一覧表示
    public function class_show() 
    {
        $gradeTable = new Grade;
        $grades = $gradeTable->allGrade();
        //dd($grades);
        return view('nursery/all_class', ['grades' => $grades]);
    }

    // クラス登録画面表示
    public function class_add_show() 
    {
        return view('nursery/class_add');
    }

    // クラスの登録
    public function class_add(ClassNameRequest $request) 
    {
        \DB::beginTransaction();
        try {
                $user = \Auth::user();
                $nursery_id = $user->nursery_id;

                $class = new Grade();
                $class->name = $request['classname'];
                $class->years = $request['years'];
                $class->teacher = $request['teacher'];
                $class->nursery_id = $nursery_id;
                $class->save();
                \DB::commit();

        } catch(\Throwable $e) {
            \DB::rollBack();
            //dd($e->getMessage());
        }
        return redirect()->route('class_show');
    }

    // 生徒一覧表
    public function student_show()
    {
        $studentTable = new User;
        $students = $studentTable->allStudent();
        //dd($students);
        return view('nursery/all_student',['students'=>$students]);
        
    }

    // 生徒登録画面表示
    public function student_add_show()
    {
        $classesTable = new Grade;
        $classes = $classesTable->className();
        return view('nursery/student_add',['classes'=>$classes]);
    }

    // 生徒登録
    public function student_add(StudentRequest $request) 
    {
        \DB::beginTransaction();
        try {
                $user = \Auth::user();
                $nursery_id = $user->nursery_id;

                $student = new User();
                $student->name = $request['studentname'];
                $student->mail = $request['mail'];
                $student->tel = $request['tel'];
                $student->password = $request['password'];
                $student->role = $request['role'];
                $student->class_id = $request['class_id'];
                $student->nursery_id = $nursery_id;
                $student->save();

                \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollBack();
            //dd($e->getMessage());
        }
        return redirect()->route('student_show');
    }

    // 生徒名取得
    public function student_name() 
    {
        $studentNameTable = new User;
        $student = $studentNameTable->getStudentName();
        return view('nursery/index');
    }











}