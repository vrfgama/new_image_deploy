<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix'=> 'image-deploy'], function(){
    // fazer rota do login
    Route::get('/input-view','UploadController@inputView')->middleware('auth');  // redireciona usuarios não logados
    Route::post('/upload', 'UploadController@upload');
    Route::get('/deploy', 'UploadController@deploy');

    Route::get( '/cancel', 'UploadController@cancel');
    
});
