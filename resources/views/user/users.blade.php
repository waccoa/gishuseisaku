@extends('adminlte::page')

@section('title', 'ユーザー一覧')

@section('content_header')
    <h1>ユーザー一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                    <!-- 検索画面 -->
                    <form method="GET" action="">
                     <input type="search" placeholder="ユーザー名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
                        <button type="submit">検索</button><br><br>
                        <!-- 検索画面 -->
                        <thead>
                            <tr>
                                <th>ユーザーID</th>
                                <th>名前</th>
                                <th>e-mail</th>
                                <th>作成日</th>
                                <th>更新日</th>
                                <th>管理者権限</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td><a href="{{ url('detail/'.$user->id) }}">{{ $user -> name }}</a></td>
                                    <td>{{ $user -> email }}</td>
                                    <td>{{ $user -> created_at }}</td>
                                    <td>{{ $user -> updated_at }}</td>
                                 <td>
                                 <!-- userのroleが1なら -->
                                @if($user->role==1)   
                                利用者
                                <!-- userのroleが1以外のとき -->
                                @else
                                管理者
                                <!-- コロン構文のif文の終わり -->
                                @endif
                               </td>
                               
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    {{ $users->appends(request()->query())->Links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
