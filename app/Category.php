<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    protected $fillable = [
        'cate_name',
        'cate_code',
    ];
    public function canChange()
    {
        if (Auth::guard('admin')->check())
            return Auth::guard('admin')->user()->type == 3;
        else
            return false;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_products');
    }
}
