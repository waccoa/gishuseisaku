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
    public function index()
    {
        // 商品一覧取得
        // $items = Item::all();
        $items = DB::table('items')
            ->select('items.name', 'items.id', 'items.type', 'items.release', 'items.status', 'users.name as user')
            ->leftJoin('users', 'items.user_id', '=', 'users.id')
            ->get();
        //allにすることで全ての項目に入る
        // $items = Item::where('status', 'active')->get();
// dd($items);
        return view('item.index', compact('items'));
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

}