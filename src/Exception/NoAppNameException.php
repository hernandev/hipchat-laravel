<?php namespace Hernandev\HipchatLaravel\Exception;

use Exception;

class NoAppNameException extends Exception
{
    protected $message = 'HipChat App Name is not configured';

    protected $code = 21;

    protected $file;

    protected $line;
}
