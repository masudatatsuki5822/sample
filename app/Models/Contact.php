<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'person','back_time','temp','breakfast','comment'
    ];


    // 保育園側の最新の連絡帳閲覧
    public function getContacts($id)
    {
        $today = Carbon::today()->format('Y-m-d'); 
        //dd($today);
        
        $contacts = Contact::join('users','contacts.user_id','=','users.id')
        ->select('users.name','contacts.person','contacts.today','contacts.back_time','contacts.temp','contacts.breakfast','contacts.comment')
        ->whereDate('contacts.created_at',$today)
        ->where('users.id', $id)
        ->latest('contacts.created_at')
        ->first();
        //dd($contacts);
        return $contacts;
    }

    // 生徒側で投稿した最新の連絡帳を確認
    public function getOneContact() 
    {
        $today = Carbon::today()->format('Y-m-d'); 
        $user_id = \Auth::user()->id;

        $contact = Contact::join('users','contacts.user_id','=','users.id')
        ->select('contacts.person','contacts.today','contacts.back_time','contacts.temp','contacts.breakfast','contacts.comment')
        ->whereDate('contacts.created_at',$today)
        ->where('users.id', $user_id)
        ->latest('contacts.created_at')
        ->first();
        //dd($contacts);
        return $contact;
    }
    
    //  保育園側の連絡帳閲覧
    //  1週間分遡って
    public function getContacts_all($id)
    {
        $today = Carbon::today();
        $weekAgo = $today->clone()->subWeek();

        $contacts_all = Contact::join('users','contacts.user_id','=','users.id')
        ->where('users.id', $id)
        ->whereBetween('contacts.today', [$weekAgo, $today])
        ->select('users.name','contacts.person','contacts.today','contacts.back_time','contacts.temp','contacts.breakfast','contacts.comment')
        ->orderBy('contacts.today', 'desc')
        ->get();
        //dd($contacts_all);
        //return $contacts_all;
        if ($contacts_all->isNotEmpty()) {
            return $contacts_all;
        } else {
            return null; // または空のコレクションを返すなど、適切な値を返す
        }
        
    }

    //  生徒側の連絡帳閲覧
    //  1週間分遡って
    public function getContact_one()
    {
        $today = Carbon::today();
        $weekAgo = $today->clone()->subWeek();
        $user_id = \Auth::user()->id;

        $contact = Contact::join('users','contacts.user_id','=','users.id')
        ->where('users.id', $user_id)
        ->whereBetween('contacts.today', [$weekAgo, $today])
        ->select('contacts.person','contacts.today','contacts.back_time','contacts.temp','contacts.breakfast','contacts.comment')
        ->orderBy('contacts.today', 'desc')
        ->get();
        //dd($contacts_all);
        //return $contacts_all;
        if ($contact->isNotEmpty()) {
            return $contact;
        } else {
            return null; // または空のコレクションを返すなど、適切な値を返す
        }

    }
    
}
