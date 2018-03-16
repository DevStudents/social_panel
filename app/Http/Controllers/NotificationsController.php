<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Notifications\FriendRequest;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('users.notifications');
    }
    public function update($id){
       DatabaseNotification::where([
           'id' => $id,
           'notifiable_id' => Auth::id(),
           ])->firstOrFail()->markAsRead();
       return back();
    }

    public function clickToMark(){
       DatabaseNotification::where('notifiable_id',Auth::id())->get()->markAsRead();
       return back();
    }
}

