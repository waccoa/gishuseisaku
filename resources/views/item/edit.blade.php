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
                            <input type="text" class="form-control" id="name" name="name"value="{{$item->name}}">
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label>
                            <select class="form-control" name="type">
                            <option value=""></option>
                            @foreach(config('const.type_name') as $key=>$val)
                            <option value="{{$key}}" @if($item->type==$key) selected @endif >{{$val}}</option>
                            @endforeach
                            </select>
                            <!-- <input type="number" class="form-control" id="type" name="type" placeholder="1, 2, 3, ..." value="{{$item->type}}"> -->
                            
                        </div>

                        <div class="form-group">
                            <label for="date">リリース日</label>
                            <input type="text" class="form-control" id="date" name="release" value="{{$item->release}}">
                        </div>

                        <div class="form-group">
                            <label for="status">状態</label>
                            <!-- <input type="text" class="form-control" id="status" name="status" placeholder="在庫あり"> -->
                            <select class="form-control" name="status" value="{{$item->status}}">
                            <!-- boot strapであらかじめ入っている class="form-control"を使うと同じデザインになる -->
                            <!-- <option value="" selected="selected">選択してください</option>
                            <option value="在庫あり">在庫あり</option>
                            <option value="レンタル中">レンタル中</option>
                            <option value="在庫なし">在庫なし</option> -->
                            @if($item->status==1)
                            <option value="1" selected>{{\App\Enums\PublishStateType::getDescription('1')}}</option> // 在庫あり
                            @elseif($item->status==2)
                            <option value="2" selected>{{\App\Enums\PublishStateType::getDescription('2')}}</option> // 在庫なし
                            @else
                            <option value="3" selected>{{\App\Enums\PublishStateType::getDescription('3')}}</option> // レンタル中
                            @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_id">ユーザー</label>
                             <!--  カテゴリープルダウン -->
                           <select class="form-control" id="user_id" name="user">
                            
                           @foreach ($users as $users)
                           <option value="{{ $users->id }}">{{ $users->name}}</option>
                           </div>
                           @endforeach
        </select>
      </div>
                            
                            </select>
                        </div>

                       </div>
 
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                        @if($item->status==2)
                        <button type="submit" class="btn btn-danger">削除</button>
                        @endif
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
