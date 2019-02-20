<?php

namespace App\Components\Sms;

use Illuminate\Support\Manager;
use Nexmo\Client as NexmoClient;
use Twilio\Rest\Client as TwilioClient;
use App\Components\Sms\Drivers\NullDriver;
use App\Components\Sms\Drivers\NexmoDriver;
use App\Components\Sms\Drivers\TwilioDriver;
use Nexmo\Client\Credentials\Basic as NexmoBasicCredentials;

class SmsManager extends Manager
{
    /**
     * Get a driver instance.
     *
     * @param  string|null  $name
     * @return mixed
     */
    public function channel($name = null)
    {
        return $this->driver($name);
    }

    /**
     * Create a Nexmo SMS driver instance.
     *
     * @return \App\Components\Sms\Drivers\NexmoDriver
     */
    public function createNexmoDriver()
    {
        return new NexmoDriver(
            $this->createNexmoClient(),
            $this->app['config']['sms.nexmo.from']
        );
    }

    /**
     * Create a Twilio SMS driver instance.
     *
     * @return \App\Components\Sms\Drivers\TwilioDriver
     */
    public function createTwilioDriver()
    {
        return new TwilioDriver(
            $this->createTwilioClient(),
            $this->app['config']['sms.twilio.from']
        );
    }

    /**
     * Create the Nexmo client.
     * 
     * @return \Nexmo\Client
    */
    protected function createNexmoClient()
    {
        return new NexmoClient(
            new NexmoBasicCredentials(
                $this->app['config']['sms.nexmo.key'],
                $this->app['config']['sms.nexmo.secret']
            )
        );
    }

    /**
     * Create the Twilio client.
     * 
     * @return \Twilio\Rest\Client
    */
    protected function createTwilioClient()
    {
        return new TwilioClient(
            $this->app['config']['sms.twilio.key'],
            $this->app['config']['sms.twilio.secret']
        );
    }


    /**
     * Create a Null SMS driver instance.
     *
     * @return \App\Components\Sms\Drivers\NullDriver
     */
    public function createNullDriver()
    {
        return new NullDriver;
    }

    /**
     * Get the default SMS driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app['config']['sms.default'] ?? 'null';
    }
}