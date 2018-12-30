@extends('layouts.app')
@section('content')

    <div>
        <!-- エラー共通部品 -->
        <!-- @include('common.errors') -->
        
    </div>

    <div>
        <a href="{{url('/items_create')}}">アイテム出品（登録）</a>
        <a href="{{url('/items_list_search')}}">アイテム一覧（検索）</a>
        <a href="{{url('/items_list_sell')}}">アイテム一覧（出品）</a>
    </div>

    <div>
        <!-- アイテム一覧（検索） -->
        @if (count($items)>0)
            <div>
                <h1>アイテム一覧</h1>
            </div>
            <div>
                @foreach ($items as $item)
                <div>
                    <div>{{$item->item_name}}</div>
                    <div>{{$item->user_id}}</div>
                    <div>{{$item->item_comment}}</div>
                    <div>{{$item->item_description}}</div>
                    <div>{{$item->item_price}}</div>
                    <div>{{$item->item_cov_img}}</div>
                    <div>{{$item->item_img1}}</div>
                    <div>{{$item->item_img2}}</div>
                    <div>{{$item->item_img3}}</div>

                    <!-- 本の更新ボタン -->
                    <td>
                        <form action="{{url('items_edit/'.$item->id)}}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">
                                <i class="glyphicon glyphicon-pencil"></i>更新
                            </button>
                        </form>
                    </td>
                    
                    <!-- 本の削除ボタン -->
                    <td>
                        <form action="{{url('items/delete/'.$item->id)}}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">
                                <i class="glyphicon glyphicon-trash"></i>削除
                            </button>
                        </form>
                    </td>

                    <br>
                </div>
                @endforeach
            </div>
            <div>
                {{ $items->links()}}
            </div>
        @endif
    </div>

@endsection