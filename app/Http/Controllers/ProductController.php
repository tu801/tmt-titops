<?php
/**
 * @author tmtuan
 * created Date: 12/5/2021
 * project: titops
 */

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
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

    /**
     * Add new product to order
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addProductToOrder(Request $request) {
        $postData = $request->all();
        $user = auth()->user();
        $response = [];

        if ( !isset($user->id) ) {
            $response['error'] = 1;
            $response['message'] = 'Please login first!';
        } else {
            //check product valid
            $productItem = Product::find($postData['product']);
            if ( !isset($productItem->id) ) {
                $response['error'] = 1;
                $response['message'] = 'Invalid Product!';
            } else {
                //check if order id exist
                if ( isset($postData['order']) && $postData['order'] > 0 ) {
                    $order = Order::find($postData['order']);
                    $orderItem = [
                        'order_id' => $order->id,
                        'product_id' => $postData['product'],
                        'price' => $productItem->price,
                        'quantity' => $postData['quantity']
                    ];

                    $odItem = OrderItem::where('order_id', $order->id)->where('product_id', $postData['product'])->first();

                    if ( isset($odItem->id) ) {
                        $odItem->quantity += $postData['quantity'];
                        $odItem->save();
                    } else {
                        OrderItem::create($orderItem);
                    }

                    $totalItems = OrderItem::where('order_id', $order->id)->get();
                    $total = 0;
                    foreach ($totalItems as $item) {
                        $total += ($item->price * $item->quantity);
                    }
                    $order->total = $total;
                    $order->save();

                    $response['error'] = 0;
                    $response['message'] = 'Add item success!';
                    $response['data'] = [
                        'id' => $order->id,
                        'code' => $order->code,
                        'total' => $order->total,
                        'items' => $order->items,
                        'cartHtml' => view('frontend.minicart', compact('order'))->render()
                    ];
                } else { //order not exist then create new order for current user
                    $lastOrder = Order::orderBy('created_at','DESC')->first();
                    $newOrder = new Order();
                    $newOrder->code = '#'.str_pad($lastOrder->id??0 + 1, 8, "0", STR_PAD_LEFT);
                    $newOrder->total = $productItem->price * $postData['quantity'];
                    $newOrder->user_init = $user->id;
                    $newOrder->save();

                    $orderItem = [
                        'order_id' => $newOrder->id,
                        'product_id' => $postData['product'],
                        'price' => $productItem->price,
                        'quantity' => $postData['quantity']
                    ];
                    OrderItem::create($orderItem);
                    $order = Order::find($newOrder->id);
                    $response['error'] = 0;
                    $response['message'] = 'Add item success!';
                    $response['data'] = [
                        'id' => $newOrder->id,
                        'code' => $newOrder->code,
                        'total' => $newOrder->total,
                        'items' => $newOrder->items,
                        'cartHtml' => view('frontend.minicart', compact('order'))->render()
                    ];
                }
            }




        }

        return response()->json($response);
    }
}
