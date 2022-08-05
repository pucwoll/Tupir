<?php namespace WIntegration\FireBasePush\Classes\Notifications;

use Illuminate\Notifications\Notification;
use Plokko\LaravelFirebase\Facades\FCM;
use WIntegration\FireBasePush\Classes\Channels\FirebasePushChannel;

class CMSNotification extends Notification
{

    protected $header;
    protected $body;
    protected $router;
    protected $externalUrl;

    public function __construct($header, $body, $router, $externalUrl)
    {
        $this->header = $header;
        $this->body = $body;
        $this->router = $router;
        $this->externalUrl = $externalUrl;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            FirebasePushChannel::class,
        ];
    }

    /**
     * Get the firebase representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toFirebasePush($notifiable)
    {

        $push = FCM::notificationTitle($this->header);
        $push->notificationBody($this->body);

        $push->data([
            'router' => $this->router ?? json_encode(config('wintegration.firebasepush::cms_notifications.router')),
            'external_url' => $this->externalUrl
        ]);

        return $push;
    }
}
