<?php namespace HeRnandEs\HipchatLaravel\Exception;

use Exception;

class NoApiTokenException extends Exception
{
    protected $message = 'HipChat Api Key could not be found';

    protected $code = 20;

    protected $file;

    protected $line;
} 