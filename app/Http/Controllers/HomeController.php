<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;
use Auth;

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
    public function index()
    {
        //return view('home');
        
        
        $user1 =  Auth::user()->id ;
        $rows1 = DB::table('products')->where('user_id', 'LIKE', $user1 )->get();
        $count1 = count($rows1);
        $products = Product::latest()->where('user_id', 'LIKE', $user1 )->paginate($count1);
        return view('home',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
            
    }
}
