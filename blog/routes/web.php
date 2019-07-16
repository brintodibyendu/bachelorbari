<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;
use App\Notifications\User_Added;
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
Route::post('/dpractice/{id}','PostsController@book_room');
Route::post('/dpractice1/{id}','PostsController@review_room');
Route::post('/dashboard/confirmroom/{id}','DashboardController@confirmroom');
Route::post('/dashboard/cancelroom/{id}','DashboardController@cancelroom');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/requestroom', 'DashboardController@requestroom');
Route::get('/dashboard/occupiedroom', 'DashboardController@occupiedroom');
Route::get('/admin/login',function(){
	return view('admin.login');
});
Route::get('/admin/forgot',function(){
	return view('admin.forgot-password');
});
Route::get('/admin/chart',function(){
	return view('admin.charts');
});
Route::get('/admin/table','AdminController@create');
Route::get('/admin/requestuser','AdminController@requestuser');
Route::get('/admin/index',function(){
	return view('admin.index');
});
Route::resource('admin','AdminController');
Route::post('/admin/confirmuser/{id}','AdminController@confirmuser');

Route::get('/video','AdminController@sendmail');
Route::get('/brinto_prac','FrontpageController@home'); 
Route::get('/home', 'HomeController@index')->name('home');
