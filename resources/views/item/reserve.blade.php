@extends('adminlte::page')

@section('title', '予約一覧')

@section('content_header') 
    <h1>予約一覧</h1>
 @stop

@section('content') 
<div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>

                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                                <th>予約日</th>
                                <th>ユーザー</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->yoyaku_date}}</td>
                                    @can('admin-role')
                                    <td>{{ $item-> user->name}}</td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop