<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        Auth::user()->notifications->markAsRead();
        return view('users.notifications');
    }
}
