<?php
/**
 * @author tmtuan
 * created Date: 12/5/2021
 * project: titops
 */

namespace App\Http\Controllers;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detail($id)
    {
        $product = Product::with(['BrandInfo' => function($qr){
            $qr->select(['id', 'name']);
        }])->find($id);
        return view('frontend.product.detail', compact('product'));
    }
}
