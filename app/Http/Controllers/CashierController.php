<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->search ? User::whereNotIn('Role', ['Admin'])->whereNotIn('is_active', [false])->where('name', 'like', '%' . $request->search . '%')->prderBy('name')->get()
                                            : User::whereNotIn('Role', ['Admin'])->whereNotIn('is_active', [false])->orderBy('name')->get();
        return Inertia::render('Cashier/Index', [
            'cashiers' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Cashier/Create');
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'address' => 'required',
            'phone' => 'required|numeric',
            'birth' => 'required|date'
        ]);

        $validate['password'] = Hash::make($validate['password']);

        $user = User::create($validate);

        Salary::create([
            'user_id' => $user->id,
            'saldo' => 0
        ]);

        return redirect('/cashiers')->with('flash', [
            'message' => 'Berhasil membuat cashier baru',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $cashier)
    {
        return Inertia::render('Cashier/Show', [
            'cashier' => $cashier
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $cashier)
    {
        return Inertia::render('Cashier/Edit', [
            'cashier' => $cashier
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $cashier)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required|numeric',
            'birth' => 'required|date'
        ];

        if($request->email != $cashier->email){
            $rules['email'] = 'required|email|unique:users';
        }

        $validate = $request->validate($rules);

        $cashier->update($validate);

        return redirect('/cashiers')->with('flash', [
            'message' => 'Berhasil merubah data kasir',
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $cashier)
    {
        $cashier->update(['is_active' => false]);

        return redirect('/cashiers')->with('flash', [
            'message' => 'Berhasil menghapus data kasir',
            'type' => 'success'
        ]);
    }
}
