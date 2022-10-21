@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- 検索画面 -->
                <form method="GET" action="/items/">
                    <input type="search" placeholder="タイトルを入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
                     <button type="submit">検索</button><br><br>
                </form>
            <!-- 検索画面 -->
             <div class="card">
             <div class="card-header">
                   
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                            @can('admin-role')
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                                <th>リリース日</th>
                                <th>状態</th>
                                <th>貸し出しユーザー</th>
                                <th>予約</th>
    
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        
                                    @can('admin-role')
                                     <a href="{{ url('items/edit/'.$item->id) }}">
                                    @endcan
                                    {{ $item -> name }}
                                    @can('admin-role')
                                    </a>
                                    @endcan
                                    </td>
                                       <!-- <td>{{ $item->name }}</td> -->
                                    <td>{{ config('const.type_name.'.$item->type) }}</td>
                                    <!--☆$type[$item->type] ☆-->
                                    <td>{{ $item->release }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                 <!-- statusが3なら -->
                                @if($item->status==1)   
                                    在庫あり
                                <!-- userのroleが1以外のとき -->
                                @elseif($item->status==2)
                                    在庫なし
                                <!-- コロン構文のif文の終わり -->
                                @else
                                    @can('admin-role')
                                        {{ $item->user }}
                                    @endcan
                                @endif
                               </td>
                               <td>
                               @if($item->status==1||$item->status==3)
                               <a href="{{ url('items/reservation/'.$item->id) }}"><button type="button" class="btn btn-success">予約</button></a>
                               @endif
                               </td>
                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                     {{ $items->appends(request()->query())->Links('pagination::bootstrap-4') }} 
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
