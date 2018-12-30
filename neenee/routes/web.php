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


/* * * * * * * * * * * * * * * * * * * * * * * *
 * CREATE
 * * * * * * * * * * * * * * * * * * * * * * * */

// アイテム 作成 （画面）
Route::get('/items_create', 'ItemsController@create');
// Route::get('/items_create', function(){
    // return view('items_create');
// });

// アイテム 作成 （処理）
Route::post('/items/create', 'ItemsController@store');
// Route::post('/items/create', function(Request $request){
    // // バリデーション
    // $validator = Validator::make($request->all(),[
    //     'item_name' => 'required|max:255',
    //     'item_comment' => 'required|max:255',
    //     'item_description' => 'required|max:255',
    //     'item_price' => 'required|max:11',
    //     'item_cov_img' => 'required|max:255',
    //     'item_img1' => 'required|max:255',
    //     'item_img2' => 'required|max:255',
    //     'item_img3' => 'required|max:255',
    // ]);
    // // バリデーションエラー
    // if ($validator->fails()){
    //     return redirect('/items_create')
    //         ->withInput()
    //         ->withErrors($validator);
    // }
    // // Eloquent Model
    // $items = new Item;
    // $items->item_name = $request->item_name;
    // $items->item_comment = $request->item_comment;
    // $items->item_description = $request->item_description;
    // $items->item_price = $request->item_price;
    // $items->item_cov_img = $request->item_cov_img;
    // $items->item_img1 = $request->item_img1;
    // $items->item_img2 = $request->item_img2;
    // $items->item_img3 = $request->item_img3;
    // $items->save();
    // // リダイレクト
    // return redirect('home');
// });


/* * * * * * * * * * * * * * * * * * * * * * * *
 * READ
 * * * * * * * * * * * * * * * * * * * * * * * */

// 元のコード
Route::get('/', function(){
    return view('welcome');
});

// アイテム 一覧 検索 (画面) = ホーム
Route::get('items_list_search', 'ItemsController@show');
// Route::get('items_list_search', function () {
    // $items = Item::orderBy('created_at', 'asc')->get();
    // return view('items_list_search', [
    //     'items' => $items,
    // ]);
// });

// あとで書く！
// アイテム 一覧 出品 (read) ※優先度低い
/*
Route::get('/hoge', function(){
    // 
});
*/

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


/* * * * * * * * * * * * * * * * * * * * * * * *
 * UPDATE
 * * * * * * * * * * * * * * * * * * * * * * * */

// アイテム 編集 出品 (画面)
Route::post('/items_edit/{items}', 'ItemsController@edit');
// Route::post('/items_edit/{items}', function(Item $items){
    // return view('items_edit', [
    //     'item' => $items
    // ]);
// });

// アイテム 編集 出品 (処理)
Route::post('/items/update', 'ItemsController@update');
// Route::post('/items/update', function(Request $request){
    // // バリデーション
    // $validator = Validator::make($request->all(), [
    //     'id' => 'required',
    //     'item_name' => 'required|max:255',
    //     'item_comment' => 'required|max:255',
    //     'item_description' => 'required|max:255',
    //     'item_price' => 'required|max:11',
    //     'item_cov_img' => 'required|max:255',
    //     'item_img1' => 'required|max:255',
    //     'item_img2' => 'required|max:255',
    //     'item_img3' => 'required|max:255',
    // ]);
    // // バリデーションエラー
    // if ($validator->fails()){
    //     return redirect('/')
    //         ->withInput()
    //         ->withErrors($validator);
    // }
    // // データ更新
    // $items = Item::find($request->id);
    // $items->item_name = $request->item_name;
    // $items->item_comment = $request->item_comment;
    // $items->item_description = $request->item_description;
    // $items->item_price = $request->item_price;
    // $items->item_cov_img = $request->item_cov_img;
    // $items->item_img1 = $request->item_img1;
    // $items->item_img2 = $request->item_img2;
    // $items->item_img3 = $request->item_img3;
    // $items->save();
    // // リダイレクト
    // return redirect('items_list_search');
// });


/*
 * DELETE
 */

// アイテム 削除 出品 (delete)
Route::post('/items/delete/{item}', 'ItemsController@destroy');
// Route::post('/items/delete/{item}', function(Item $item){
    // $item->delete();
    // return redirect('home');
// });

// 今回は対象外・・・
// アイテム 削除 購入 (delete) ※優先度低い
/* 
Route::post('/hoge', function(){
    // 
});
 */


Auth::routes(); // 認証機能が既に実装されている
Route::get('/home', 'HomeController@index')->name('home'); // ->name('home')はそのままでよいか？

