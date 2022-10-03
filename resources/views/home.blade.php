@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>図書管理システム</h1>
@stop

@section('content')
    <p>Welcome to this admin panel.</p>
    <div class="panel-body table">
  
    <table class="table table-striped">
 
      <thead>
                <th class="text-center">名前</th>
                <th class="text-center">商品ID</th>
                <th class="text-center">種別</th>
                <th class="text-center">リリース日</th>
                <th class="text-center">状態</th>
     </thead>
     <!-- テーブル本体 -->
           <tbody>
               
                <tr class="border">
                    <!-- 名前 -->
                    <td class="table-text text-center">
                       
                    </td>
                    

                    <!-- ID -->
                    <td class="table-text text-center"></td>
                    
                    <!-- 種別 -->
                    <td class="table-text text-center"></td>
                   
                    <!-- リリース日 -->
                    <td class="table-text text-center"></td>
                    
                    <!-- 状態 -->
                    <td class="table-text text-center"></td>

                </tr>    
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


        