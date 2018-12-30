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

use App\Item;
use Illuminate\Http\Request; // ファイルが見つからない・・・？

/*
|--------------------------------------------------------------------------
| Create
|--------------------------------------------------------------------------
*/

// アイテム 作成 （画面）
Route::get('/items_create', 'ItemsController@create');

// アイテム 作成 （処理）
Route::post('/items/create', 'ItemsController@store');

/*
|--------------------------------------------------------------------------
| Read
|--------------------------------------------------------------------------
*/

// 元のコード
Route::get('/', function(){
    return view('welcome');
});

// アイテム 一覧 検索 (画面) = ホーム
Route::get('items_list_search', 'ItemsController@show');

// アイテム 一覧 出品 (画面) 
Route::get('/items_list_sell', 'ItemsController@showSellingItems');

// あとで書く！
// アイテム 一覧 購入 (read) ※優先度低い
/*
Route::get('/hoge', function(){
    // 
});
*/

// アイテム 詳細 検索 (read)
/*
Route::get('/hoge', function(){
    // 
});
*/

// あとで書く！
// アイテム 詳細 出品 (read) ※優先度低い
/*
Route::get('/hoge', function(){
    // 
});
*/

// あとで書く！
// アイテム 詳細 購入 (read) ※優先度低い
/*
Route::get('/hoge', function(){
    // 
});
*/


/*
|--------------------------------------------------------------------------
| Update
|--------------------------------------------------------------------------
*/

// アイテム 編集 出品 (画面)
Route::post('/items_edit/{items}', 'ItemsController@edit');

// アイテム 編集 出品 (処理)
Route::post('/items/update', 'ItemsController@update');


/*
|--------------------------------------------------------------------------
| Delete
|--------------------------------------------------------------------------
*/

// アイテム 削除 出品 (delete)
Route::post('/items/delete/{item}', 'ItemsController@destroy');

// 今回は対象外・・・
// アイテム 削除 購入 (delete) ※優先度低い
/* 
Route::post('/hoge', function(){
    // 
});
 */


Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home'); // ->name('home')はそのままでよいか？ ->laravel5.5以降の仕様っぽい
Route::get('/home', 'ItemsController@show')->name('home'); // mypageはhomeとは別に作ろう
