<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::latest()->get();
        return Inertia::render('Purchase/Index', [
            'purchases' => $purchases
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::whereNotIn('is_active', [false])->latest()->get();
        $suplliers = Supplier::whereNotIn('is_active', [false])->latest()->get();
        return Inertia::render('Purchase/Create', [
            'products' => $products,
            'suppliers' => $suplliers
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
            'product_code' => 'required',
            'qty' => 'required|numeric',
            'total' => 'required|numeric',
            'description' => 'nullable',
            'supplier_id' => 'required|numeric'
        ]);

        $validate['code_trx'] = 'TRXPCS' . Str::upper(Str::random(10));
        $validate['date_trx'] = Carbon::now()->isoFormat('Y-MM-D');

        $purchase = Purchase::create($validate);

        $product = Product::where('product_code', $purchase->product_code)->first();
        $product->update(['stock' => ($product->stock + $purchase->qty)]);

        return redirect('/purchases')->with('flash', [
            'message' => 'Berhasil membuat suatu pembelian',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
