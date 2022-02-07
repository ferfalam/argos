<?php

namespace App\Notifications;

use App\EmailNotificationSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuperAdminOfflinePayment extends BaseNotification
{
    use Queueable;
    private $name;
    private $fname;
    private $bic;
    private $iban;
    private $bank;
    private $agency;

    public function __construct($name,$fname,$bic,$iban,$bank,$agency)
    {
        parent::__construct();
        $this->name = $name;
        $this->fname = $fname;
        $this->bic = $bic;
        $this->iban = $iban;
        $this->bank = $bank;
        $this->agency = $agency;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Bank Deposit Payment Submitted' . ' - ' . config('app.name'))
                    ->line('Name: '.$this->name)
                    ->line('First Name: '.$this->fname)
                    ->line('BIC: '.$this->bic)
                    ->line('IBAN: '.$this->iban)
                    ->line('BANK: '.$this->bank)
                    ->line('AGENCY: '.$this->agency);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
