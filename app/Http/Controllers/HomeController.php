<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
         $items = DB::table('items')
        ->select('items.name', 'items.id','items.type', 'items.rental_date','items.yoyaku_date')
        ->leftJoin('users', 'items.user_id', '=', 'users.id')
        ->where('users.id','=',Auth::id())
        ->get();
        

        
       
   
    return view('home', compact('items'));
    }
}
