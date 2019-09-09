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
/*Route::get('/', function () {
    $products        = json_decode(file_get_contents(storage_path('data/products-data.json')));
    $selectedId      = intval(app('request')->input('id') ?? '5');
    $selectedProduct = $products[0];
    $selectedProducts = array_filter($products, function ($product) use ($selectedId) { return $product->id === $selectedId; });
    if (count($selectedProducts)) {
        $selectedProduct = $selectedProducts[array_keys($selectedProducts)[0]];
    }
    return $selectedProducts ;
    $productSimilarity = new App\ProductSimilarity($products);
    $similarityMatrix  = $productSimilarity->calculateSimilarityMatrix();
    $products          = $productSimilarity->getProductsSortedBySimularity($selectedId, $similarityMatrix);
    return view('ai_intro', compact('selectedId', 'selectedProduct', 'products'));
});*/
//Route::get('/','PagesController@index');
Route::get('/',function(){
return view('practice');
});
Route::get('/about',function(){
   return view('pages.about');
});

Route::get('/services','PagesController@services');
Route::get('/VIP','PostsController@showvip');
Route::get('/INDIVIP/{id}','PostsController@showindivip');
Route::post('/VIPBOOK/{id}','PostsController@bookvip');
// Route::get('/users/{id}/{name}',function($id,$name){
//    return 'this is '.$id.'with name '.$name;
// });
Route::get('/search','PostsController@search');
Route::get('/admin/showuser/{id}','AdminController@showindiuser');
Route::get('/admin/pdfini/{id}','AdminController@pdfindiuser');
Route::get('/advancesearch','PostsController@advancesearch');
Route::resource('posts','PostsController');
Auth::routes();
Route::post('/dpractice/{id}','PostsController@book_room');
Route::post('/dashboard/advertise/{id}/{id1}/{id2}/{id3}','DashboardController@advertise');
Route::post('/dpractice1/{id}','PostsController@review_room');
Route::post('/dashboard/confirmroom/{id}/{id1}','DashboardController@confirmroom');
Route::post('/dashboard/cancelroom/{id}/{id1}','DashboardController@cancelroom');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/requestroom', 'DashboardController@requestroom');
Route::get('/dashboard/occupiedroom', 'DashboardController@occupiedroom');
Route::get('/dashboard/occupiedroom/pdf', 'DashboardController@pdf');
Route::get('/admin/table/pdf', 'AdminController@pdf');
Route::get('/admin/login',function(){
	return view('admin.login');
});
Route::get('/popup',function(){
    return view('modalpopup');
});
Route::get('/admin/forgot',function(){
	return view('admin.forgot-password');
});
Route::get('/admin/chart','AdminController@Showchart');
Route::get('/admin/table','AdminController@create');
Route::get('/admin/requestuser','AdminController@requestuser');
Route::get('/admin/index',function(){
	return view('admin.index');
});
Route::resource('admin','AdminController');
Route::post('/admin/confirmuser/{id}','AdminController@confirmuser');
Route::post('/admin/blockuser/{id}','AdminController@Blockuser');
Route::post('/admin/unblockuser/{id}','AdminController@UnBlockuser');
Route::get('/video','AdminController@sendmail');
Route::get('/brinto_prac','FrontpageController@home'); 
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/dashboard/cancelwantingroom/{id}','DashboardController@cancelwantingroom');
Route::get('/dashboard/wantingroom','DashboardController@wantingroom');
Route::get('/notify','DashboardController@notify');