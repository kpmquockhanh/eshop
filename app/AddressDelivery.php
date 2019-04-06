<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressDelivery extends Model
{
    protected $fillable = [
        'order_id',
        'name',
        'phone',
        'note',
        'address',
    ];
}
