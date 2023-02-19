<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->search ? Product::whereNotIn('is_active', [false])->where('name', 'like', '%' . $request->search . '%')->latest()->get() :
                                    Product::whereNotIn('is_active', [false])->latest()->get();

        return Inertia::render('Product/Index', [
            'products' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();

        return Inertia::render('Product/Create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'image' => 'required|image',
            'name' => 'required',
            'category_id' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $validate['product_code'] = 'PRD' . Str::upper(Str::random(10));
        $validate['slug'] = Str::slug($validate['name'] . date('Y-m-d'));

        if($request->file('image')){
            $path = $request->file('image')->store('product_image');

            $validate['image'] = $path;
        }

        Product::create($validate);

        return redirect('/products')->with('flash', [
            'message' => 'Berhasil membuat produk baru',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::whereNotIn('id', [$product->category_id])->latest()->get();
        return Inertia::render('Product/Edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules =  [
            'image' => 'required',
            'name' => 'required',
            'category_id' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock' => 'required|numeric'
        ];


        if($request->file('image')){
            $rules['image']  =  'required|image';
            $pathImage = $request->file('image')->store('product_image');
            Storage::delete($product->image);
        }

        $validate = $request->validate($rules);

        $validate['image'] = $request->file ? $pathImage : $validate['image'];

        $validate['slug'] = $validate['slug'] = Str::slug($validate['name'] . date('Y-m-d'));

        $product->update($validate);

        return redirect('/products')->with('flash', [
            'message' => 'Berhasil merubah data produk',
            'type' => 'success'
        ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->update(['is_active' => false]);

        return redirect('/products')->with('flash', [
            'message' => 'Berhasil menghapus data produk',
            'type' => 'success'
        ]);
    }
}
