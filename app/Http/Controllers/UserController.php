<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

  

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    // public function edit(Request $request,$id)
    // {
    //     $user=User::find($id);
    //     return view("user.form",[
    //         'user' => $user,
    //     ]);
    // }
    /**
     * 商品一覧
     */
    public function users(Request $request)
    {
        // ユーザー一覧取得
        $users = User::all();
        $search = $request->input('search');
        $query = User::query();
        if ($search) {
            //SQL発行しただけ
            $query->where('name', 'like', '%'.$search.'%')->orderBy('id');
            //実際に検索実行、Getでも可能
            $users=$query->paginate(10);
        } else {
        
            $users = User::orderBy('id')->paginate(10); 
        }
      
        //allにすることで全ての項目に入る
        // $items = Item::where('status', 'active')->get();

        return view('user.users', compact('users','search'));
    }
    public function detail(Request $request,$id)
    //public function detail()の中に値を入れることで操作する
    {
        // ユーザー詳細
        $user = User::find($id);
        //userにすることで一つの項目の詳細を表示
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);
            $user->id = $request->id;
            $user->name = $request->name;
             // 三項演算子、式の結果がTRUEの場合は真の式を返し、結果がFALSEの場合は偽の式を返す
             //変数2＝(変数1=="ほげ1") ? "ほげ2" : "ほげ3"
             //１．変数1が「ほげ1」と同じだったら変数2に「ほげ2」を入れてね２．違ったら変数2に「ほげ3」を入れてね
             //ctrl,shift,zで進む
            $user->role = $request->role == 'on' ? 2 : 1;
            $user->save();
            return redirect('/users');
            //getメソッドで表示させたいとき
        }
        return view('user.detail', compact('user'));
        //post保存された状態で見たい時
        //userのdetailを表示、compact関数にてviewとcontrollerの関数が同じ時に処理できる
    
}

}