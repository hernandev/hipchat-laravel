<?php namespace HeRnandEs\HipchatLaravel\Exception;

use Exception;

class RoomNotDefinedException extends Exception
{
    protected $message = 'HipChat Room was not set.';

    protected $code = 22;

    protected $file;

    protected $line;
} 