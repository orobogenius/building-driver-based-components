<?php

namespace App\Components\Sms\Contracts;

interface SMS
{
    /**
     * Send the given message to the given recipient.
     * 
     * @return mixed
     */
    public function send();
}