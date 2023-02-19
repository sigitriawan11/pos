<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = $request->search ? Supplier::whereNotIn('is_active', [false])->where('name', 'like', '%' . $request->search . '%')->latest()->get()
                                            : Supplier::whereNotIn('is_active', [false])->latest()->get();
        return Inertia::render('Supplier/Index', [
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Supplier/Create');
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
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required'
        ]);

        $validate['is_active'] = true;

        Supplier::create($validate);

        return redirect('/suppliers')->with('flash', [
            'message' => 'Berhasil menambahkan supplier',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return Inertia::render('Supplier/Edit', [
            'supplier' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validate = $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required'
        ]);

        $supplier->update($validate);

        return redirect('/suppliers')->with('flash', [
            'message' => 'Berhasil merubah data supplier',
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->update(['is_active' => false]);

        return redirect('/suppliers')->with('flash', [
            'message' => 'Berhasil menghapus data supplier',
            'type' => 'success'
        ]);
    }
}
