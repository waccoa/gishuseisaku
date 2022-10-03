@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1>商品編集</h1>
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
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前" value="{{$item->name}}">
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label>
                            <input type="number" class="form-control" id="type" name="type" placeholder="1, 2, 3, ..." value="{{$item->type}}">
                        </div>

                        <div class="form-group">
                            <label for="date">リリース日</label>
                            <input type="text" class="form-control" id="date" name="release" placeholder="詳細説明" value="{{$item->release}}">
                        </div>

                        <div class="form-group">
                            <label for="status">状態</label>
                            <!-- <input type="text" class="form-control" id="status" name="status" placeholder="在庫あり"> -->
                            <select class="form-control" name="status">
                            <!-- boot strapであらかじめ入っている class="form-control"を使うと同じデザインになる -->
                            <!-- <option value="" selected="selected">選択してください</option>
                            <option value="在庫あり">在庫あり</option>
                            <option value="レンタル中">レンタル中</option>
                            <option value="在庫なし">在庫なし</option> -->
                            
                            <option value="1">{{\App\Enums\PublishStateType::getDescription('1')}}</option> // 在庫あり
                            <option value="2">{{\App\Enums\PublishStateType::getDescription('2')}}</option> // 在庫なし
                            <option value="3">{{\App\Enums\PublishStateType::getDescription('3')}}</option> // レンタル中
                           
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
