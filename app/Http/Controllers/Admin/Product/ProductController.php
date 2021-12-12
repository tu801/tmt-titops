<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProductController.
 */
class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(25);
        return view('admin.products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $brands = ProductBrand::get();
        $images = ProductImage::where('user_init', $user->id)->where('product_id', 0)->get(); 
        return view('admin.products.create', compact('brands', 'images'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        request()->validate([
            'name' => 'required',
            'price' => 'required',
            'brand_id' => 'required',
            //'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // $imageName = time().'.'.$request->images->extension();

        // $request->images->storeAs('public/uploads/products', $imageName);
        $newProduct = new Product($request->all());
        // $newProduct->images = $imageName;
        $newProduct->save();

        //update product images
        ProductImage::where('user_init', $user->id)->where('product_id', 0)
                    ->update(['product_id' => $newProduct->id]);

        return redirect()->route('admin.product.list')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function detail($id, Product $product)
    {
        $product = Product::with(['BrandInfo' => function($qr){
            $qr->select(['id', 'name']);
        }])->find($id);
        return view('admin.products.detail',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = ProductBrand::get();
        $product = Product::find($id);
        $user = auth()->user();
        $brands = ProductBrand::get();
        $images = ProductImage::where('user_init', $user->id)->where('product_id', $product->id)->get(); 
        return view('admin.products.edit',compact('product', 'brands', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         request()->validate([
             'name' => 'required',
             'price' => 'required',
             'brand_id' => 'required',
             'images' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product = Product::find($id);
        $oldImg = $product->images;
        $product->fill($request->all());
        if ($request->hasFile('images')) {
            $imageName = time().'.'.$request->images->extension();

            $request->images->storeAs('public/uploads/products', $imageName);
            Storage::delete('public/uploads/products/'.$oldImg);
            $product->images = $imageName;
        }
        $product->save();

        return redirect()->route('admin.product.list')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Product::find($id)->delete();

        return redirect()->route('admin.product.list')
                        ->with('success','Product deleted successfully');
    }


    public function uploadImages($id, Request $request) {
        $user = auth()->user();
        $response = [];
        if ( !isset($user->id) ) {
            $response['error'] = 1;
            $response['message'] = 'please Login First!';
        } else { 
            $imgUpload = $request->file('pdtImgs'); 
            $new_name = rand() . '.' . $imgUpload->getClientOriginalExtension();
            $imgUpload->storeAs('public/uploads/products', $new_name);
            $imgData = [
                'user_init' => $user->id,
                'product_id' => $id ?? 0,
                'name' => $new_name
            ];
            ProductImage::create($imgData);

            $images = ProductImage::where('user_init', $user->id)->where('product_id', $id ?? 0)->get();

            $response = array(
                'error' => 0,
                'message'  => 'Multiple Image File Has Been uploaded Successfully',
                'images' => $images,
                'html' => view('admin.products.pdt-images', compact('images'))->render()
            );
        }
        
        return response()->json($response);
    }
}
