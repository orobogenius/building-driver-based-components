<?php

namespace App\Components\Sms\Drivers;

use Illuminate\Support\Arr;
use App\Components\Sms\Contracts\SMS;
use App\Components\Sms\Exceptions\SmsException;

abstract class Driver implements SMS
{
    /**
     * The recipient of the message.
     * 
     * @var string
    */
    protected $recipient;

    /**
     * The message to send.
     * 
     * @var string
    */
    protected $message;

    /**
     * {@inheritdoc}
     */
    abstract public function send();

    /**
     * Set the recipient of the message.
     * 
     * @param string  $recipient
     * 
     * @throws \App\Components\Sms\Exceptions\SmsException
     * 
     * @return $this
    */
    public function to(string $recipient)
    {
        throw_if(is_null($recipient), SmsException::class, 'Recipients cannot be empty');

        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Set the content of the message.
     * 
     * @param string  $message
     * 
     * @throws \App\Components\Sms\Exceptions\SmsException
     * 
     * @return $this
    */
    public function content(string $message)
    {
        throw_if(empty($message), SmsException::class, 'Message text is required');

        $this->message = $message;

        return $this;
    }
}