<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductBrand;
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
        $brands = ProductBrand::get();
        return view('admin.products.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'price' => 'required',
            'brand_id' => 'required',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->images->extension();

        $request->images->storeAs('public/uploads/products', $imageName);
        $newProduct = new Product($request->all());
        $newProduct->images = $imageName;
        $newProduct->save();

        return redirect()->route('admin.product.list')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show',compact('product'));
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
        return view('admin.products.edit',compact('product', 'brands'));
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

}
