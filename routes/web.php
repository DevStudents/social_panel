<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


                //USERS
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search', 'SearchController@users');

Route::get('/user-avatar/{id}/{size}','ImagesController@user_avatar');



Route::resource('/users', 'UsersController',['except' => ['index','create','store','destroy']]);

Route::resource('/posts', 'PostsController',['except' => ['index','create']]);

Route::resource('/comments', 'CommentsController',['except' => ['index','create','show']]);


                 //FREIENDS
Route::get('/users/{id}/friends','FriendsController@index');

Route::post('/friends/{friend}','FriendsController@add');

Route::patch('/friends/{friend}','FriendsController@accept');

Route::delete('/friends/{id}','FriendsController@delete');

                   //LIKES

Route::post('/like','LikesController@add');

Route::delete('/like','LikesController@destroy');

                 //NOTIFICATIONS

Route::get('/notifications','NotificationsController@index');
Route::patch('/notifications/{id}','NotificationsController@update');