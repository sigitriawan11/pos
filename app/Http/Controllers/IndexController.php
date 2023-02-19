<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request){
        $products = $request->search ? Product::where('name', 'like', '%' . $request->search . '%')->whereNotIn('is_active', [false])->latest()->get() : Product::whereNotIn('is_active', [false])->latest()->get();
        $categories = Category::latest()->get();

        return Inertia::render('Index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function createTransaction(Request $request){
        $validate = $request->validate([
            'total_pay' => 'required|numeric',
            'transaction_details' => 'required'
        ]);

        $validate['total_price'] = 0;

        foreach($validate['transaction_details'] as $transaction){

            $validate['total_price'] += $transaction['total_price'];
        }

        $create = Transaction::create([
            'total_pay' => $validate['total_pay'],
            'total_price' => $validate['total_price'],
            'code_trx' => 'TRX'. Str::upper(Str::random(10)),
            'date_trx' => Carbon::now()->isoFormat('Y-MM-D'),
            'change' => $validate['total_pay'] - $validate['total_price'],
            'user_id' =>  Auth::user()->id
        ]);


        foreach($validate['transaction_details'] as $transaction){
            $transaction['code_trx'] = $create->code_trx;
            $product = Product::where('product_code', $transaction['product_code'])->first();

            $product->update(['stock' => ($product->stock - $transaction['qty'])]);

            TransactionDetail::create([
                'product_code' => $transaction['product_code'],
                'qty' => $transaction['qty'],
                'total_price' => $transaction['total_price'],
                'code_trx' => $transaction['code_trx'],
            ]);
        }

        return redirect('/transaction/success/' . $create->code_trx)->with('flash', [
            'message' => 'Berhasil membuat transaksi',
            'type' => 'success'
        ]);

    }

    public function transactionSuccess(Transaction $transaction){
        $transaction = Transaction::with(['user', 'transaction_details'])
        ->where('code_trx', $transaction->code_trx)
        ->first();

        return Inertia::render('Transaction/Success', [
            'title' => $transaction->code_trx,
            'transaction' => $transaction
        ]);
    }

    public function transactions(){
        $transactions = Transaction::with('transaction_details')->where('date_trx', Carbon::now()->isoFormat('Y-MM-D'))->where('user_id', Auth::user()->id)->latest()->get();

        return Inertia::render('Transaction/Index', [
            'transactions' => $transactions
        ]);
    }
}
