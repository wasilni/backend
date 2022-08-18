<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomerCancelRequestNotification extends Notification
{
    use Queueable;
  public $title_ar;
       public $title_en;
 public $body_ar;
       public $body_en;

    public function __construct($title_ar,$title_en,$body_ar,$body_en)
    {
     $this->title_ar=$title_ar;
     $this->title_en=$title_en; 

    $this->body_ar=$body_ar; 
    $this->body_en=$body_en; 

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
     return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
           
            'title_ar'=> $this->title_ar,
             'title_en'=> $this->title_en,

            'body_ar'=> $this->body_ar,
             'body_en'=> $this->body_en,



        ];
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
