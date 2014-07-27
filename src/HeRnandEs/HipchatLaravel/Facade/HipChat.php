<?php namespace HeRnandEs\HipchatLaravel\Facade;

use Illuminate\Support\Facades\Facade;

class HipChat extends Facade
{
    protected static function getFacadeAccessor() { return 'hipchat-laravel'; }
} 