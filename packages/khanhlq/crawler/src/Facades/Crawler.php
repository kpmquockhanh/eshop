<?php
/**
 * Created by PhpStorm.
 * User: kpmqu
 * Date: 2/12/2018
 * Time: 9:10 PM
 */

namespace Khanhlq\Crawler\Facades;


use Illuminate\Support\Facades\Facade;

class Crawler extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Crawler';
    }
}