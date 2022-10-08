@extends('adminlte::page')

@section('title', 'ユーザー詳細')

@section('content_header')
    <h1>ユーザー詳細</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-10">
            <!-- カラムの幅 -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name"  value="{{$user->name}}">
                        </div>

                        <div class="form-group">
                            <label for="email">e-mail</label>
                            <input type="text" class="form-control" id="email" name="email"  value="{{$user->email}}">
                            <!-- input type=に入れることで表示させたい内容がみれる -->
                        </div>

                        <div class="form-group">
                       <div class="col-md-10">
                      <input type="checkbox" name="role" value="on" {{ $user->role == 2 ? 'checked' : '' }}>
                      <label class="col-md-3 control-label" for="role">管理者</label>
    
                       </div>
  </div>
                        

                       </div>
 
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop