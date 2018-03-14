<?php

use App\Friend;
use App\User;
use Illuminate\Support\Facades\Auth;


    function friendship($friend_id)
    {
        $friend_query = Friend::where([
                ['friend_id', '=', $friend_id],
                ['user_id', '=', Auth::id()]]
        )->orWhere([
                ['friend_id', '=', Auth::id()],
                ['user_id', '=', $friend_id]]
        )->get();


        if (empty($friend_query[0]->accepted)) {
            $status = 1;
            return $status;
        } else {
            return $friend_query[0]->accepted;
        }
    }

            function to_accept($id){
           $to_accept = Friend::where([
               ['friend_id','=', Auth::id()],
                ['user_id','=',$id]
           ])->get();

           if (empty($to_accept[0])) {
               return 1;
           } else {
               return 2;
           }
       }


       function admin(){
           return (Auth::check() && Auth::user()->role->role_name === 'admin');
       }



