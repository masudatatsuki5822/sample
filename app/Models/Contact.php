<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'back_time','temp','breakfast','comment'
    ];


    //  保育園側の連絡帳閲覧
    public function getContacts($id)
    {
        $today = Carbon::today()->format('Y-m-d'); 
        //dd($today);
        
        $contacts = Contact::join('users','contacts.user_id','=','users.id')
        ->select('users.name','contacts.today','contacts.back_time','contacts.temp','contacts.breakfast','contacts.comment')
        ->whereDate('contacts.created_at',$today)
        ->where('users.id', $id)
        ->latest('contacts.created_at')
        ->first();
        //dd($contacts);
        return $contacts;
    }
}
