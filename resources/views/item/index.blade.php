@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
             <div class="card">
             <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
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
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ url('items/edit/'.$item->id) }}">{{ $item -> name }}</a></td>
                                    <!-- <td>{{ $item->name }}</td> -->
                                    <td>{{ $item->type }}</td>
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
                                {{ $item->user }}
                                @endif
                               </td>
                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
