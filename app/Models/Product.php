<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $with = ['category'];

    protected $primaryKey = "product_code";
    protected $keyType = 'string';

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
