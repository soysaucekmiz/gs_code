@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

<!-- テスト -->
<div>
    <a href="{{url('/items_create')}}">アイテム出品（登録）</a>
    <a href="{{url('/items_list_search')}}">アイテム一覧（検索）</a>
</div>

@endsection
