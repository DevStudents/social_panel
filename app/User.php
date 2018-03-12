<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','sex','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //RELATIONS

    //posts
    public function post(){
      return  $this->hasMany('App\Post')->orderBy('created_at','desc');
    }

    //friends

    // friend list collection
    public function friend_1(){
        return $this->belongsToMany('App\User','friends','user_id','friend_id')
        ->wherePivot('accepted',3);
    }
    public function friend_2(){
        return $this->belongsToMany('App\User','friends','friend_id','user_id')
            ->wherePivot('accepted',3);
    }
    public function friends(){
        return $this->friend_1->merge($this->friend_2);
    }

    //friend requests
    public function accept(){
        return $this->belongsToMany('App\User','friends','friend_id','user_id')
            ->wherePivot('accepted',2)->get();
    }

}
