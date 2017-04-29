<?php

use App\Events\UserSignedUp;
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

    //publish an event with redis
    // $data = [
    // 	'event'=>'UserSignedUp',
    // 	'data'=>[
    // 		'username'=>'JohnDoe'
    // 	]
    // ]; 

    // Redis::publish('test-channel', json_encode($data));
    // event(new UserSignedUp($user)); // whatever u wanna publish
    // event(new UserSignedUp('JohnDoe'));

    return 'Welcome to HomePage';
   	
});

Route::get('/chat', [
    'uses' => 'ChatController@showMessages'
]);

Route::post('/chat/message', [
    'uses' => 'ChatController@sendMessages'
]);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
