<?php
/**
 * Author: Xavier Au
 * Date: 10/3/2018
 * Time: 11:07 AM
 */

namespace Anacreation\School\Notification\ServiceProviders;


use Anacreation\School\Notification\Contracts\EmailSender;
use SendGrid as SG;
use SendGrid\ReplyTo;

class SendGrid implements EmailSender
{

    private $sg;
    private $from;
    private $to;
    private $subject;
    private $cc = [];
    private $bcc = [];
    private $plainTextContent = null;
    private $contents = [];
    private $htmlContent = null;
    private $replyTo;
    private $response;

    /**
     * SendGrid constructor.
     */
    public function __construct() {
        $apiKey = config('school_notification.SendGrid.apikey');
        $this->sg = new SG($apiKey);
    }

    public function from(string $name, string $fromEmailAddress): EmailSender {

        $this->from = new SG\Email($name, $fromEmailAddress);

        return $this;

    }

    public function to(string $name, string $toEmailAddress): EmailSender {
        $this->to = new SG\Email($name, $toEmailAddress);

        return $this;

    }

    public function subject(string $subject): EmailSender {
        $this->subject = $subject;

        return $this;

    }

    public function cc(array $emailAddresses): EmailSender {
        $this->cc = $emailAddresses;

        return $this;

    }

    public function bcc(array $emailAddresses): EmailSender {
        $this->bcc = $emailAddresses;

        return $this;

    }

    public function textContent(string $content): EmailSender {

        $this->contents[] = new SG\Content("text/plain",
            "and easy to do anywhere, even with PHP");

        return $this;

    }

    public function htmlContent(string $content): EmailSender {
        $this->contents[] = new SG\Content("text/html",
            "<h1>and easy to do anywhere, even with PHP</h1>");

        return $this;

    }

    public function replyTo(string $emailAddress, string $name = null
    ): EmailSender {

        $this->replyTo = new ReplyTo($emailAddress, $name);

        return $this;

    }

    public function send(): EmailSender {

        $mail = null;
        for ($i = 0; $i < count($this->contents); $i++) {
            $content = $this->contents[$i];
            if ($mail) {
                $mail->addContent($content);
            } else {
                $mail = new SG\Mail($this->from, $this->subject, $this->to,
                    $content);
            }
        }

        if ($mail === null) {
            throw new \Exception("No mail object!");
        }


        foreach ($this->cc as $cc) {
            $mail->personalization[0]->addCc($cc);
        }
        foreach ($this->bcc as $bcc) {
            $mail->personalization[0]->addBcc($bcc);
        }

        if ($this->replyTo) {
            $mail->setReplyTo($this->replyTo);
        }

        var_dump($mail);

        $this->response = $this->sg->client->mail()->send()
                                           ->post($mail);

        var_dump($this->response->statusCode());
        var_dump($this->response->headers());
        var_dump($this->response->body());

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponse() {
        return $this->response;
    }
}