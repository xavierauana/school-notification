<?php
/**
 * Author: Xavier Au
 * Date: 9/3/2018
 * Time: 2:26 PM
 */

use Anacreation\School\Notification\Models\Email;
use Anacreation\School\Notification\Models\Mobile;

return [
    "from"      => [
        "sms"   => "A & A Creation",
        "email" => [
            "name"    => "A & A Creation",
            "address" => "info@anacreation.com",
        ],
    ],
    'channels'  => [
        'email'  => Email::class,
        'mobile' => Mobile::class,
    ],
    "providers" => [
        "sms"   => \Anacreation\School\Notification\ServiceProviders\Nexmo::class,
        "email" => \Anacreation\School\Notification\ServiceProviders\SendGrid::class
    ],
    'SendGrid'  => [
        'apikey' => env("SENDGRID_API")
    ],
    'nexmo'     => [
        'apikey' => env("NEXMO_API_KEY"),
        'secret' => env("NEXMO_SECRET")
    ]
];