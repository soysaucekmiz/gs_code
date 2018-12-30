<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use Validator;
use Auth;

class ItemsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Constructor（auth認証）
    |--------------------------------------------------------------------------
    */
    public function __construct(){
        $this->middleware('auth');
    }

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    // アイテム 作成 （画面）
    public function create(){
        return view('items_create');
    }

    // アイテム 作成 （処理）
    public function store(Request $request){
        // バリデーション
        $validator = Validator::make($request->all(),[
            'item_name' => 'required|max:255',
            'item_comment' => 'required|max:255',
            'item_description' => 'required|max:255',
            'item_price' => 'required|max:11',
            'item_cov_img' => 'required|max:255',
            'item_img1' => 'required|max:255',
            'item_img2' => 'required|max:255',
            'item_img3' => 'required|max:255',
        ]);
        // バリデーションエラー
        if ($validator->fails()){
            return redirect('/items_create')
                ->withInput()
                ->withErrors($validator);
        }
        // Eloquent Model
        $items = new Item;
        $items->user_id = Auth::user()->id;
        $items->item_name = $request->item_name;
        $items->item_comment = $request->item_comment;
        $items->item_description = $request->item_description;
        $items->item_price = $request->item_price;
        $items->item_cov_img = $request->item_cov_img;
        $items->item_img1 = $request->item_img1;
        $items->item_img2 = $request->item_img2;
        $items->item_img3 = $request->item_img3;
        $items->save();
        // リダイレクト
        return redirect('items_list_sell');
    }


    /*
    |--------------------------------------------------------------------------
    | Read
    |--------------------------------------------------------------------------
    */

    // アイテム 一覧 検索 (画面) = ホーム
    public function show(){
        $items = Item::orderBy('created_at', 'desc')->paginate(3);
        return view('items_list_search', [
            'items' => $items,
        ]);
    }

    // アイテム 一覧 出品 (画面) ※あとでviewとauth追加！！
    public function showSellingItems(){
        $items = Item::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        return view('items_list_sell', [
            'items' => $items,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    // アイテム 編集 出品 (画面)
    public function edit($item_id){
        $items = Item::where('user_id', Auth::user()->id)->find($item_id);
        return view('items_edit', [
            'item' => $items
        ]);
    }

    // アイテム 編集 出品 (処理)
    public function update(Request $request){
        // バリデーション
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'item_name' => 'required|max:255',
            'item_comment' => 'required|max:255',
            'item_description' => 'required|max:255',
            'item_price' => 'required|max:11',
            'item_cov_img' => 'required|max:255',
            'item_img1' => 'required|max:255',
            'item_img2' => 'required|max:255',
            'item_img3' => 'required|max:255',
        ]);
        // バリデーションエラー
        if ($validator->fails()){
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        // データ更新
        $items = Item::where('user_id', Auth::user()->id)->find($request->id);
        $items->item_name = $request->item_name;
        $items->item_comment = $request->item_comment;
        $items->item_description = $request->item_description;
        $items->item_price = $request->item_price;
        $items->item_cov_img = $request->item_cov_img;
        $items->item_img1 = $request->item_img1;
        $items->item_img2 = $request->item_img2;
        $items->item_img3 = $request->item_img3;
        $items->save();
        // リダイレクト
        return redirect('items_list_sell');
    }


    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    // アイテム 削除 出品 (delete) 
    public function destroy(Item $item){
        $item->delete();
        return redirect('items_list_sell');    
    }
    // 下記、user_idが一致するものだけ削除許可しようと思ったがうまくいかなかった
    // public function destroy(Request $request){
    //     $items = Item::where('user_id', Auth::user()->id)->find($request->id);
    //     $items->delete();
    //     return redirect('home');
    // }

}
