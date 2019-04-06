<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{

    protected $fillable = [
        'product_id',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
