<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    const ACTIVE = 1;
    const DEACTIVEVATE = 1;

    protected $fillable = [
        'admin_id',
        'shipper_name',
        'shipper_phone',
        'shipper_status_code',
    ];

    protected $status_name = [
        0 => 'Không khả dụng',
        1 => 'Khả dụng',
    ];

    public function getNameStatusAttribute(){
        return array_get($this->status_name,$this->shipper_status_code);
    }

    public static function getActiveShippers()
    {
        return self::query()
            ->where('shipper_status_code', self::ACTIVE)->get();
    }
}
