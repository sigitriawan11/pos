<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {

        $transaction = Transaction::chartTotalTransaction();
        $purchase = Purchase::chartTotalPurchase();
        $cashier = User::whereNotIn('is_active', [false])->latest()->get();

        return Inertia::render('Dashboard', [
            'transaction' => $transaction,
            'purchase' => $purchase,
            'cashier' => $cashier->count(),
            'products' => Product::whereNotIn('is_active', [false])->latest()->get()->count(),
            'total_transaction' => Transaction::totalTransaction(),
            'total_purchase' => Purchase::totalPurchase()
        ]);
    }
}
