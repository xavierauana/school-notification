<?php

namespace Anacreation\School\Notification\Notifications;

use Anacreation\School\Models\Language;
use Anacreation\School\Notification\Contracts\SmsSender;
use Anacreation\School\Notification\Models\Mobile;
use Anacreation\School\Notification\Models\Notice;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SendNotification extends Notification
{
    use Queueable;
    /**
     * @var \Anacreation\School\Notification\Models\Notice
     */
    private $notice;

    /**
     * Create a new notification instance.
     *
     * @param \Anacreation\School\Notification\Models\Notice $notice
     * @param \Anacreation\School\Models\Language            $language
     */
    public function __construct(Notice $notice, Language $language) {
        //
        $this->notice = $notice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable) {

        return $notifiable->prefer_sms ? ['sms'] : ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        var_dump('going to send mail');

        //        return (new MailMessage)
        //            ->line('The introduction to the notification.')
        //            ->action('Notification Action', url('/'))
        //            ->line('Thank you for using our application!');
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toSms($notifiable) {

        $number = optional($notifiable->communicationChannels()
                                      ->whereCommunicationType(Mobile::class)
                                      ->first())->channel->full_number;

        $sender = app()->make(SmsSender::class);

        $sender->to($number)
               ->from(config("school_notification.from.sms"))
               ->message($this->notice->getMessage($this->language->code))
               ->send();

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
            //
        ];
    }
}
