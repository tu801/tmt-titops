<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

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
        $products = Product::with(['BrandInfo' => function($qr){
            $qr->select(['id', 'name']);
        }])->get();

        //get customer pending order
        $user = auth()->user();
        $order = Order::where('user_init', $user->id)
                ->where('status', 'pending')->first();
                
        return view('frontend.home', compact('products', 'order'));
    }
}
