<?php

namespace App\Components\Sms\Drivers;

use Nexmo\Client as NexmoClient;

class NexmoDriver extends Driver
{
    /**
     * The Nexmo client.
     * 
     * @var \Nexmo\Client
    */
    protected $client;

    /**
     * The phone number this sms should be sent from.
     *
     * @var string
     */
    protected $from;

    /**
     * Create a new Nexmo driver instance.
     *
     * @param  \Nexmo\Client  $nexmo
     * @param  string  $from
     * @return void
    */
    public function __construct(NexmoClient $nexmo, $from)
    {
        $this->client = $nexmo;
        $this->from = $from;
    }

    /**
     * {@inheritdoc}
    */
    public function send()
    {
        return $this->client->message()->send([
            'type' => 'text',
            'from' => $this->from,
            'to' => $this->recipient,
            'text' => trim($this->message)
        ]);
    }
}