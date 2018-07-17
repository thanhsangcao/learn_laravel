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

// Route::get('/', function () {
//     return 'Hello world';
// });

Route::get('/','PagesController@home');
Route::get('/about','PagesController@about');
Route::get('/contact','PagesController@contact');

Route::get('/contact','TicketsController@create');
Route::post('/contact','TicketsController@store');

Route::get('/tickets', 'TicketsController@index');

Route::group(['prefix' => 'ticket'], function(){
	Route::get('/{slug?}', 'TicketsController@show');
	Route::get('/{slug?}/edit','TicketsController@edit');
	Route::post('/{slug?}/edit','TicketsController@update');
	Route::post('/{slug?}/delete','TicketsController@destroy');
});

Route::get('sendemail', function () {

    $data = array(
        'name' => "Learning Laravel",
    );

    Mail::send('emails.welcome', $data, function ($message) {

        $message->from('sangcao1003@gmail.com', 'Learning Laravel');

        $message->to('sangcao1003@gmail.com')->subject('Learning Laravel test email');

    });

    return "Your email has been sent successfully";

});
Route::post('/comment', 'CommentsController@newComment');

Route::group(['prefix' => 'users', 'namespace' => 'Auth'], function(){
	Route::get('register', 'RegisterController@showRegistrationForm');
	Route::post('register', 'RegisterController@register');

	Route::get('logout', 'LoginController@logout');

	Route::get('login', 'LoginController@showLoginForm')->name('login');
	Route::post('login', 'LoginController@login');
});


Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth')
, function () {
	Route::get('users', 'UsersController@index');
});
