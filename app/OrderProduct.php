<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
    ];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
