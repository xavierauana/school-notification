<?php
/**
 * Author: Xavier Au
 * Date: 10/3/2018
 * Time: 11:03 AM
 */

namespace Anacreation\School\Notification\Contracts;


interface SmsSender
{

    /**
     * @param string $receiverNumber
     * @return \Anacreation\School\Notification\Contracts\SmsSender
     */
    public function to(string $receiverNumber): SmsSender;

    /**
     * @param string $senderNumber
     * @return \Anacreation\School\Notification\Contracts\SmsSender
     */
    public function from(string $senderNumber): SmsSender;

    /**
     * @param string $message
     * @return \Anacreation\School\Notification\Contracts\SmsSender
     */
    public function message(string $message): SmsSender;

    /**
     * @return \Anacreation\School\Notification\Contracts\SmsSender
     */
    public function send(): SmsSender;

    /**
     * @return mixed
     */
    public function getResponse();
}