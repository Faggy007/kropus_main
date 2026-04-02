<?php

namespace Modules\ContactForm\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ManagerContactForm extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private ?string $subject = null,
        private array   $data = []
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $message = new MailMessage;

        $message->greeting($this->subject);
        $message->subject($this->subject);

        foreach ($this->data as $key => $item) {

            $itemTranslationString = 'contact_form::attribute.' . $key;
            $itemTranslation = __($itemTranslationString);
            if ($itemTranslation === $itemTranslationString) {
                $itemTranslation = $key;
            }

            if (!is_string($item)) {
                $item = json_encode($item);
            }

            $message->line(new HtmlString('<p><strong>' . $itemTranslation . '</strong>: ' . htmlspecialchars($item) . '</p>'));
        }

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
