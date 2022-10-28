@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
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
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前">
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label>
                            <!-- <input type="number" class="form-control" id="type" name="type" > -->
                            <select class="form-control" name="type">
                            <option value="" selected="selected">選択してください</option>
                            @foreach(config('const.type_name') as $key=>$val)
                            <option value="{{$key}}" {{old('type')==$key ? "selected" : ""}}>{{$val}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="date">リリース日</label>
                            <input type="text" class="form-control" id="date" name="release" placeholder="詳細説明">
                        </div>

                        <div class="form-group">
                            <label for="status">状態</label>
                            <!-- <input type="text" class="form-control" id="status" name="status" placeholder="在庫あり"> -->
                            <select class="form-control" name="status">
                            <option value="" selected="selected">選択してください</option>
                            <!-- <option value="在庫あり">在庫あり</option>
                            <option value="レンタル中">レンタル中</option>
                            <option value="在庫なし">在庫なし</option> -->
                            <option value="1">在庫あり</option> 
                            <option value="2">在庫なし</option>
                            <option value="3">レンタル中</option> 
                            </select>
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
