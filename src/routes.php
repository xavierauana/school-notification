<?php
/**
 * Author: Xavier Au
 * Date: 9/3/2018
 * Time: 6:40 PM
 */

Route::group([
    "namespace"  => "Anacreation\\School\\Notification\\Http\\Controllers",
    "middleware" => ["web"]
], function () {
    Route::resource("contacts", "ContactsController");

    Route::get("test/mail", function () {
        $from = new SendGrid\Email("Example User", "test@example.com");
        $subject = "Sending with SendGrid is Fun";
        $to = new SendGrid\Email("Example User", "xavier.au@anacreation.com");
        $content = new SendGrid\Content("text/plain",
            "and easy to do anywhere, even with PHP");
        $mail = new SendGrid\Mail($from, $subject, $to, $content);

        $apiKey = env('SENDGRID_API');
        $sg = new \SendGrid($apiKey);

        $response = $sg->client->mail()->send()->post($mail);

        dd($response);
    });
    Route::get("test/sms", function () {
        $sender = app()->make(\Anacreation\School\Notification\Contracts\SmsSender::class);
        $sender->to("85266281556")
               ->message("this is a testing message")
               ->send();


        dd($sender->getResponse());
    });
});