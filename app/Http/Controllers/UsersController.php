<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
   public function __construct()
   {
       $this->middleware('permission',['except' => ['show']]);
   }

    public function show($id)
    {   $user = User::findOrFail($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request,[
          'name'=>'required|min:2',
          'email'=>[
              'required',
              'email',
              Rule::unique('users')->ignore($id),
          ],
      ],[
          'required' => "You have to put something here",
          'email' => "Jeez.. Just give me correct email. I promise to never spam you",
          'unique' => "This email is already taken...",
          'min' => "C'mon your name must be at least :min characters long..."
      ]);


        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->sex = $request->sex;
            if($request->file('avatar')){
                $upload_path = 'public/users/'.$id.'/avatars/';
                $path = $request->file('avatar')->store($upload_path);
                $avatar = str_replace($upload_path.'/','',$path);
                $user->avatar = $avatar;
            }
        $user->save();


        return back();
    }

}
