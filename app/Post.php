<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'post_content',
    ];

    protected $dates = ['deleted_at'];

    public function user(){
       return $this->belongsTo('App\User');
    }
    public function comment(){
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }

}
