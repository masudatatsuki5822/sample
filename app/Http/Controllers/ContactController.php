<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\DependencyInjection\AddAnnotatedClassesToCachePass;
use App\Models\Contact;
use App\Models\Grade;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    // 連絡帳投稿画面表示
    public function contact_write()
    {
        $carbon = Carbon::today();
        return view('contact/write',['carbon' => $carbon]);
    }

    // 連絡帳投稿
    public function contact_send(ContactRequest $request)
    {
        //ログイン中のユーザーIDと保育園IDを定義
        $user = \Auth::user();
        $user_id = $user->id;
        $class_id = $user->class_id;
        $nursery_id = $user->nursery_id;

        \DB::beginTransaction();
        try {
            $contact = new Contact();
            $contact->nursery_id = $nursery_id;
            $contact->class_id = $class_id;
            $contact->user_id = $user_id;
            $contact->person = $request['person'];
            $contact->today = Carbon::createFromFormat('Y/m/d',$request['today']); 
            $contact->back_time = Carbon::createFromFormat('H:i',$request['back_time']);
            $contact->temp = $request['temp'];
            $contact->breakfast = $request['breakfast'];
            $contact->comment = $request['comment'];

            $contact->save();
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollBack();
            //dd($e->getMessage());
        }
        return redirect()->route('index');
    }
    // 連絡帳のクラスを選択画面表示
    public function contact_classShow()
    {
        $classesTable = new Grade;
        $classes = $classesTable->className();
        //dd($grades);
        return view('contact/class',['classes'=>$classes]);
    }

    // ログイン中の保育園の中から選択したクラスの生徒のみ取得
    public function contact_student_select(Request $request) 
    {
        // セレクトボックスから送信されたクラスIDを定義
        $classId = $request->input('class_id');

        // 選択したクラスの生徒のみ取得
        $students = User::join('grades','users.class_id','=','grades.id')
        ->where('class_id',$classId)
        ->select('users.id','users.name AS studentName','grades.name AS className','grades.years')
        ->get();
        //dd($students);
        return view('contact/student',['students'=> $students]);

    }

    // 生徒一覧から送られてきたuser_idと同じ連絡帳を取得する
    public function contact_show($id) 
    {
        $contactsTable = new Contact;
        $contacts = $contactsTable->getContacts($id);

        // 日付と時刻を表示したいフォーマットに変換
        $today = Carbon::createFromFormat('Y-m-d H:i:s', $contacts->today)->format('Y/m/d');
        $back_time = Carbon::createFromFormat('Y-m-d H:i:s', $contacts->back_time)->format('H:i');

        return view('contact/read',['contacts' =>$contacts , 'today' =>$today ,'back_time' =>$back_time ]);
    }

    // 生徒側から投稿した連絡帳を確認
    public function contact_show_one() 
    {
        $contactsTable = new Contact;
        $contact = $contactsTable->getOneContact();

        // 日付と時刻を表示したいフォーマットに変換
        $today = Carbon::createFromFormat('Y-m-d H:i:s', $contact->today)->format('Y/m/d');
        $back_time = Carbon::createFromFormat('Y-m-d H:i:s', $contact->back_time)->format('H:i');

        return view('contact/read',['contact' =>$contact , 'today' =>$today ,'back_time' =>$back_time ]);
    }


    // 生徒一覧から送られてきたuser_idと同じ連絡帳を取得する
    // 全て遡って
    public function contact_show_all($id)
    {
        $contactsTable = new Contact;
        $contacts_all = $contactsTable->getContacts_all($id);
        //dd($contacts_all);

        // 日付と時刻を表示したいフォーマットに変換
        // foreach($contacts_all as $contact) {
        //     $todayList = Carbon::createFromFormat('Y-m-d H:i:s', $contact->today)->format('Y/m/d');
        //     $back_timeList = Carbon::createFromFormat('Y-m-d H:i:s', $contact->back_time)->format('H:i');
        // }

        $todayList = Carbon::createFromFormat('Y-m-d H:i:s', $contacts_all->today)->format('Y/m/d');
        $back_timeList = Carbon::createFromFormat('Y-m-d H:i:s', $contacts_all->back_time)->format('H:i');
        dd($todayList);
        return view('contact/read_all',['contacts_all' =>$contacts_all , 'todayList' =>$todayList ,'back_timeList' =>$back_timeList ]);
    }





}
