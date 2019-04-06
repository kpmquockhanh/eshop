<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'created_at',
        'updated_at',
    ];
    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function getCart()
    {
        return Cart::with('product')->where('user_id', Auth::guard('user')->id())->get();
    }
}
