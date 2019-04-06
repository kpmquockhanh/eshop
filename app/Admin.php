<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class Admin extends Authenticatable
{
    const ADMIN_CODE = 3;
    const MOD_CODE = 2;
    const SALER_CODE = 1;

    const ACTIVE_STATUS = 1;
    const DEACTIVATE_STATUS = 0;
    public function canChange()
    {
        if (Auth::guard('admin')->check())
            return $this->id == Auth::guard('admin')->id() || (Auth::guard('admin')->user()->type == 3 && $this->type !=3);
        else
            return false;
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','location','status','type', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $name_type = [
        1 => 'Saler',
        2 => 'Deverloper',
        3 => 'Admin',
    ];

    protected $status_name = [
        0 => 'Vô hiệu hóa',
        1 => 'Kích hoạt',
    ];

    public function getNameTypeAttribute(){
        return array_get($this->name_type,$this->type);
    }

    public function getNameStatusAttribute(){
        return array_get($this->status_name,$this->status);
    }

    public function isOperator()
    {
        return $this->status == self::ACTIVE_STATUS && $this->type >= self::MOD_CODE;
    }

    public function isAdmin()
    {
        return $this->status == self::ACTIVE_STATUS && $this->type == self::ADMIN_CODE;
    }


}
