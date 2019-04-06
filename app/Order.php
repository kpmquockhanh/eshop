<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @property integer $id
 * @property integer $user_id
 * @property integer $payment_id
 * @property integer $shipper_id
 * @property integer $address_delivery_id
 * @property integer $transaction_status
 * @property \DateTime $ship_date
 * @property \DateTime $payment_date
 * @property integer $total_price
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 *
 * @package App
 */
class Order extends Model
{
    protected $fillable = [
        'user_id',
        'payment_id',
        'shipper_id',
        'transaction_status',
        'total_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }

    public function address_delivery()
    {
        return $this->belongsTo(AddressDelivery::class);
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function Products()
    {
        return $this->belongsToMany(Product::class, 'order_products');
    }

    private $status_type = [
        'Chờ xét duyệt',
        'Đang xử lí',
        'Đang vận chuyển',
    ];
    private $status_color = [
        'primary',
        'info',
        'success',
    ];
    public function getStatusAttribute()
    {
        return array_get($this->status_type, $this->transaction_status);
    }
    public function getStatusTextColorAttribute()
    {
        return array_get($this->status_color, $this->transaction_status);
    }
}
