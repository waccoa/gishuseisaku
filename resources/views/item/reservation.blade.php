@extends('adminlte::page')

@section('title', '予約')

@section('content_header')
    <h1>予約フォーム</h1>
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
                <form method="POST" action="{{ url('items/reserve') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前" value="{{$item->name}}">
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
                            <label for="date">予約日</label>
                            <?php $date=new DateTime();?>
                            <input type="text" class="form-control" id="name" name="date" placeholder="名前" value="{{$date->format('Y-m-d')}}" readonly>
                        </div>
                        </div>
                        <div class="card-footer">
                        <!-- <button type="button" class="btn btn-success">予約</button> -->
                        <input type="submit" class="btn btn-success">
                     </div>
                 </form>
           </div>
    </div>
    </div>
    </div>

 @stop
@section('css')
@stop

@section('js')
@stop