<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');



//category routes
Route::group(array('prefix' => "/category"), function(){
    Route::get('/' , 'FeedCategoryController@list');
    Route::get('/add' , 'FeedCategoryController@add');
    Route::get('/edit/{id}' , 'FeedCategoryController@edit');
    Route::get('/view/{id}' , 'FeedCategoryController@view');
    Route::post('/store' , 'FeedCategoryController@store');
    Route::post('/delete' , 'FeedCategoryController@delete');
});

//feed source routes
Route::group(array('prefix' => "/sources"), function(){
    Route::get('/' , 'FeedSourcesController@list');
    Route::get('/add' , 'FeedSourcesController@add');
    Route::get('/edit/{id}' , 'FeedSourcesController@edit');
    Route::get('/view/{id}' , 'FeedSourcesController@view');
    Route::post('/store' , 'FeedSourcesController@store');
    Route::post('/delete' , 'FeedSourcesController@delete');
});


//profile routes
Route::get('/profile' , 'ProfileController@index');
Route::post('/profile' ,'ProfileController@update');