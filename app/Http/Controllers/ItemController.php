<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\User;

  

class ItemController extends Controller
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
    public function index(Request $request)
    {
        // 商品一覧取得
        // $items = Item::all();
        //leftjoinをすることにより左のテーブルと右のテーブルを結合できる
        $query = DB::table('items')
            ->select('items.name', 'items.id', 'items.type', 'items.release', 'items.status', 'users.name as user')
            ->leftJoin('users', 'items.user_id', '=', 'users.id');
            
        //  $query = Item::query();
        $search = $request->input('search');
        // $query = Item::query();
        // dump(isset($search));
        if (isset($search)) {
            //SQL発行しただけ
            $items = $query->where('items.name', 'like', '%'.$search.'%')->orderBy('items.id')->paginate(1);
            //実際に検索実行、Getでも可能
            // $items->paginate(10);
        
        } else {
        
            $items =  $query->orderBy('items.id')->paginate(10); 

    
        }
        //allにすることで全ての項目に入る
        // $items = Item::where('status', 'active')->get();
      
        //$types=Item::TYPE_NAME;
        return view('item.index', compact('items','search'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき、この処理にてbladeにindexがいらない
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'release' => $request->release,
                'status' => $request->status,
                'rental_date' => date('Y-m-d'),
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }

    /**
     * 商品編集 $item=Item::find($id);でpostの役割
     */
    public function edit(Request $request,$id)
    {
        $item=Item::find($id);
        $users = User::all();
        //usersのuserを全てもってくる
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);


            $item->id = $request->id;
            $item->name = $request->name;
            $item->type = $request->type;
            $item->release = $request->release;
            $item->status = $request->status;
            $item->user_id = $request->user;
            $item->save();
            //$item->save();をしないとデーターが保存されない
            
            // 商品編集
            // Item::create([
            //     'user_id' => Auth::user()->id,
            //     'name' => $request->name,
            //     'type' => $request->type,
            //     'release' => $request->release,
            //     'status' => $request->status,
            // ]);

            return redirect('/items');
        }

        return view('item.edit',['item' => $item,'users' => $users]);
        //editに編集したitemを入れる配列？
    
    }
      /**
     * レンタル一覧
     */
    public function rental(Request $request)
    {
        $item=Item::oldest('rental_date')->where('status','=',3)->get();
        
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);


            $item->id = $request->id;
            $item->name = $request->name;
            $item->type = $request->type;
            $item->release = $request->release;
            $item->status = $request->status;
            $item->rental_date = date('Y-m-d');
            $item->save();
            return redirect('/items');
        }

        return view('item.rental',['items' => $item]);
        //itemのrentalをitems関数を利用しcontrollerの$itemを使用し表示
    }
    /**
     * 予約システム 
     */
    public function reservation(Request $request,$id)
    {
        $item=Item::find($id);
        // POSTリクエストのとき
        // if ($request->isMethod('post')) {
        //     // バリデーション
        //     $this->validate($request, [
        //         'name' => 'required|max:100',
        //     ]);

        //     $item->id = $request->id;
        //     $item->name = $request->name;
        //     $item->type = $request->type;
        //     $item->rental_date = date('Y-m-d');
        //     $item->save();
        //     return redirect('/items/reserve/list');
        //     // return view('item.reserve',['item' => $item]);   
        // }
        return view('item.reservation',['item' => $item]);
        //itemのrentalをitems関数を利用しcontrollerの$itemを使用し表示
    }
    /**
     * 商品一覧から予約フォームへ
     */
//     public function kari(Request $request)
//     {
//         // Get＊リロード・リンク・リダイレクトなどページを見たい時
//         if ($request->isMethod('post')) {
      
           
//         $item->id = $request->id;
//         $item->name = $request->name;
//         $item->type = $request->type;
//         $item->rental_date = date('Y-m-d');
//         $item->save();
//         return view('item.reserve',['item' => $item]); 
        
//     }
//     return redirect('/items');
// }
    /**
     * 予約フォーム
     */
    public function reserve(Request $request)
    {
    //   dd($request->all());
        // POSTリクエストのとき
         $item = Item::find($request->id);
            
            $item->name = $request->name;
            $item->type = $request->type;
            $item->status = 1;
            $item->yoyaku_date = $request->date;
            $item->user_id = Auth::user()->id;
            $item->save();
            return redirect('/items/reserve/list');
        

        
        //itemのrentalをitems関数を利用しcontrollerの$itemを使用し表示
    }
    /**
     * 予約し予約一覧へ
     */
    public function reserve_list(Request $request){
       
    $item = new Item;
      $items=$item->leftJoin('users', 'items.user_id', '=', 'users.id')
      ->whereNotNull('yoyaku_date')->orderBy('yoyaku_date')
      ->select('items.*')
      ->get();
        return view('item.reserve',['items' => $items]);
    }

     /**
     * 削除処理
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        // レコードを削除
        $item->delete();
        // 削除したら一覧画面にリダイレクト
        return redirect('/items');
    }
}