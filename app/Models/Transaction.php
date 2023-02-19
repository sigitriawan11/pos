<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = [];

    public function getRouteKeyName()
    {
        return 'code_trx';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transaction_details(){
        return $this->hasMany(TransactionDetail::class, 'code_trx', 'code_trx');
    }

    static public function chartTotalTransaction(){
        $day = Transaction::whereDay('created_at', Carbon::now()->isoFormat('D'))->get()->count();
        $month = Transaction::whereMonth('created_at', Carbon::now()->isoFormat('MM'))->get()->count();
        $year = Transaction::whereYear('created_at', Carbon::now()->isoFormat('Y'))->get()->count();
        $all = Transaction::latest()->get()->count();

        return [
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'all' => $all
        ];
    }

    static public function totalTransaction(){
        $all = Transaction::latest()->get()->sum('total_price');
        return $all;
    }
}
