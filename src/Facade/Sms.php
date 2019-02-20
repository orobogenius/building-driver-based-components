<?php

namespace App\Components\Sms\Facade;

use Illuminate\Support\Facades\Facade;

class Sms extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'sms';
    }
}