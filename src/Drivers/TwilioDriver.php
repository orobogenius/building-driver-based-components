<?php

namespace App\Components\Sms\Drivers;

use Twilio\Rest\Client as TwilioClient;

class TwilioDriver extends Driver
{
    /**
     * The Twilio client.
     * 
     * @var \Twilio\Rest\Client
    */
    protected $client;

    /**
     * The phone number this sms should be sent from.
     *
     * @var string
     */
    protected $from;

    /**
     * Create a new Twilio driver instance.
     *
     * @param  \Twilio\Rest\Client  $twilio
     * @param  string  $from
     * @return void
    */
    public function __construct(TwilioClient $twilio, $from)
    {
        $this->client = $twilio;
        $this->from = $from;
    }

    /**
     * {@inheritdoc}
    */
    public function send()
    {
        return $this->client->messages->create(
            $this->recipient, [
                'from' => $this->from,
                'body' => trim($this->message)
            ]
        );
    }
}