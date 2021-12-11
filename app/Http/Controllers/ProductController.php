<?php
/**
 * @author tmtuan
 * created Date: 12/5/2021
 * project: titops
 */

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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
     * Show the product detail page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detail($id)
    {
        $product = Product::with(['BrandInfo' => function($qr){
            $qr->select(['id', 'name']);
        }])->find($id);

        //get customer pending order
        $user = auth()->user();
        $order = Order::where('user_init', $user->id)
                ->where('status', 'pending')->first();

        return view('frontend.product.detail', compact('product', 'order'));
    }

    public function addProductToOrder() {

    }
}
