<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;
use Illuminate\Support\Facades\Auth;
use App\User;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id){
       /* $list_user = Friend::where([
        ['friend_id',$id],
            ['accepted',3]
        ])->orWhere([
            ['user_id',$id],
            ['accepted',3]
        ])->simplePaginate(8);
        */
       $list_user = User::findOrFail($id)->friends();
       //var_dump($list_user);
      // exit;
        return view('users.friends',compact('list_user','id'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add($friend_id)
    {
        if(friendship($friend_id) == 1){
            Friend::create([
                'user_id' => Auth::id(),
                'friend_id' => $friend_id,
            ]);
        }
        elseif(friendship($friend_id) == 2){
            $this->accept($friend_id);
        }

        return back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
       Friend::where([
           ['user_id',$id],
           ['friend_id',Auth::id()]
           ])->update(['accepted' => 3]);
       return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
      Friend::where([
                ['friend_id', '=', $id],
                ['user_id', '=', Auth::id()]]
        )->orWhere([
                ['friend_id', '=', Auth::id()],
                ['user_id', '=', $id]]
        )->delete();
      return back();
    }
}
