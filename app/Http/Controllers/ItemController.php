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
        dump(isset($search));
        if (isset($search)) {
            //SQL発行しただけ
            $items = $query->where('items.name', 'like', '%'.$search.'%')->orderBy('items.id')->paginate(1);
            //実際に検索実行、Getでも可能
            // $items->paginate(10);
            // dd($items);
        } else {
        
            $items =  $query->orderBy('items.id')->paginate(10); 

    
        }
        //allにすることで全ての項目に入る
        // $items = Item::where('status', 'active')->get();
        // dd($items);
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

        return view('item.edit',['item' => $item]);
        //editに編集したitemを入れる配列？
    
    }
    public function rental(Request $request)
    {
        $item=Item::where('status','=',3)->get();
    
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
}