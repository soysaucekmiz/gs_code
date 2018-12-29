@extends('layouts.app')
@section('content')

    <div>
        <!-- エラー共通部品 ※未実装 -->
        <!-- @include('common.errors') -->
        
    </div>

    <div>
        <!-- アイテム一覧（検索） -->
        @if (count($items)>0)
            <div>
                アイテム一覧
            </div>
            <div>
                @foreach ($items as $item)
                    <div>{{$item->item_name}}</div>
                @endforeach
            </div>
        @endif
    </div>

@endsection