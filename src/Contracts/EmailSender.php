<?php
/**
 * Author: Xavier Au
 * Date: 10/3/2018
 * Time: 11:06 AM
 */

namespace Anacreation\School\Notification\Contracts;


interface EmailSender
{
    public function from(string $name, string $fromEmailAddress): EmailSender;

    public function to(string $name, string $toEmailAddress): EmailSender;

    public function subject(string $sg): EmailSender;

    public function cc(array $emailAddresses): EmailSender;

    public function bcc(array $emailAddresses): EmailSender;

    public function textContent(string $content): EmailSender;

    public function htmlContent(string $content): EmailSender;

    public function replyTo(string $emailAddress): EmailSender;

    public function send(): EmailSender;

    public function getResponse();
}