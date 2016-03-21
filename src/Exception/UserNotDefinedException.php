<?php

namespace Hernandev\HipchatLaravel\Exception;

use Exception;

class UserNotDefinedException extends Exception
{
    protected $message = 'HipChat User was not set. Use "HipChat::setUser($id)" first;';

    protected $code = 23;

    protected $file;

    protected $line;
}
