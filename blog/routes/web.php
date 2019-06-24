<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
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
Route::post('/dashboard/confirmroom/{id}','DashboardController@confirmroom');
Route::post('/dashboard/cancelroom/{id}','DashboardController@cancelroom');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/requestroom', 'DashboardController@requestroom');
Route::get('/dashboard/occupiedroom', 'DashboardController@occupiedroom');

Route::get('/home', 'HomeController@index')->name('home');
