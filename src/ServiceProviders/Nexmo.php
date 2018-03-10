<?php
/**
 * Author: Xavier Au
 * Date: 10/3/2018
 * Time: 11:05 AM
 */

namespace Anacreation\School\Notification\ServiceProviders;


use Anacreation\School\Notification\Contracts\SmsSender;
use Nexmo\Client;
use Nexmo\Client\Credentials\Basic;

class Nexmo implements SmsSender
{

    private $client;
    private $to;
    private $from;
    private $message;
    private $response;

    /**
     * Nexmo constructor.
     */
    public function __construct() {

        $apikey = config("school_notification.nexmo.apikey");
        $secret = config("school_notification.nexmo.secret");
        $this->client = new Client(new Basic($apikey, $secret));
    }

    public function to(string $receiverNumber): SmsSender {
        $this->to = $receiverNumber;

        return $this;
    }

    public function from(string $senderNumber): SmsSender {
        $this->from = $senderNumber;

        return $this;
    }

    public function message(string $message): SmsSender {
        $this->message = $message;

        return $this;
    }

    public function send(): SmsSender {
        $data = [
            'to'   => $this->to,
            'text' => $this->message,
            'from' => $this->from ?? "NO_FROM"
        ];
        $response = $this->client->message()->send($data);

        $this->response = $response;

        return $this;
    }

    public function getResponse() {
        return $this->response;
    }

}