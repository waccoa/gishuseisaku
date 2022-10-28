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
                            <select class="form-control" name="status" >
                                
                            @for($i=1;$i<3;$i++)
                            value="{{ $i }}" {{ $i = $item->status ? 'selected' : '' }}"
                           
                            
                            <option value="1" @if($item->status == 1) selected
                            @endif>在庫あり</option> 
                            <option value="2" @if($item->status == 2) selected
                            @endif>在庫なし</option> 
                            <option value="3" @if($item->status == 3) selected
                            @endif>レンタル中</option> 
            
                            @endfor
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
               
                </div>
                    <div class="card-footer">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                <button type="submit" class="btn btn-primary">登録</button>
                                </div>
                                </form>
                                <div class="col-6 justify-content-end">
                                @if($item->status==2)
                            
                                <form action="{{ route('item.destroy', ['id'=>$item->id]) }}" method="POST">
                                @csrf 
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <button type="submit" class="btn btn-danger">削除</button>
                                </form>
                                 @endif  
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-12">
                            <div>
                                <button type="submit" class="btn btn-primary">登録</button>
                                @if($item->status==2)
                            
                                <form action="{{ route('item.destroy', ['id'=>$item->id]) }}" method="POST">
                                 @csrf 
                                <button type="submit" class="btn btn-danger">削除</button>
                                </form>
                                @endif
                            </div>
                        </div> -->
                    </div>
                        
                               
</form>
        </div>
       
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
