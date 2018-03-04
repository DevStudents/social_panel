<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;

class SearchController extends Controller
{
    public function users()
    {
       $search_phrase = Input::get('q');
       $results = User::where('name','like','%'.$search_phrase.'%')->simplePaginate(8);

       return view('search.users',compact('results','search_phrase'));
    }
}
