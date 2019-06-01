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
//     return view('welcome');
//     //return 'Hello World';
// });

/*Route::get('/hello', function () {
   // return view('welcome');
    return '<h1>Hello World</h1>';
});*/
//Route::get('/','PagesController@index');
Route::get('/',function(){
return view('practice');
});
Route::get('/about',function(){
   return view('pages.about');
});

Route::get('/services','PagesController@services');
// Route::get('/users/{id}/{name}',function($id,$name){
//    return 'this is '.$id.'with name '.$name;
// });
Route::get('/search','PostsController@search');
Route::resource('posts','PostsController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
