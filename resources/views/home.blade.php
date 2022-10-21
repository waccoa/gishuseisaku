@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>図書管理システム</h1>
@stop

@section('content')
    <p>Welcome to this admin panel.</p>
    <div class="panel-body table">
  
    <table class="table table-striped">
    
 
      <thead class="thead-dark">
            <th>ID</th>
            <th>名前</th>
            <th>種別</th>
            <th>貸し出し日</th>
            <th>返却日</th>
            <th>予約日</th>
     </thead>
     <!-- テーブル本体 -->
           <tbody>
          
               @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ config('const.type_name.'.$item->type) }}</td>
                                    <td>{{ $item->rental_date }}</td>
                                    <?php $date=new DateTime($item->rental_date);?>
                                    <td>{{ $date->modify('+14 days')->format('Y-m-d') }}</td>
                                    <td>{{ $item->rental_date }}</td>
                                </tr>
                            @endforeach
                         
            </tbody>
    </table>
       
       
    </div>
    

    
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


        