<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['product', 'supplier'];

    public function getRouteKeyName()
    {
        return 'code_trx';
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_code', 'product_code');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    static public function chartTotalPurchase(){
        $day = Purchase::whereDay('created_at', Carbon::now()->isoFormat('D'))->get();
        $month = Purchase::whereMonth('created_at', Carbon::now()->isoFormat('MM'))->get();
        $year = Purchase::whereYear('created_at', Carbon::now()->isoFormat('Y'))->get();
        $all = Purchase::latest()->get();

        return [
            'day' => $day->sum('total'),
            'month' => $month->sum('total'),
            'year' => $year->sum('total'),
            'all' => $all->sum('total')
        ];
    }

    static public function totalPurchase(){
        $all = Purchase::latest()->get()->sum('total');

        return $all;

    }
}
