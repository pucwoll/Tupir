<?php namespace AppTupir\Notification\Classes\PushNotifications;

use Plokko\LaravelFirebase\Facades\FCM;
use Illuminate\Notifications\Notification;
use AppTupir\Catchphrase\Models\Catchphrase;
use WIntegration\FireBasePush\Classes\Channels\FirebasePushChannel;

class NewCatchphraseNotification extends Notification
{
    protected $catchphrase;

    public function __construct(Catchphrase $catchphrase)
    {
        $this->catchphrase = $catchphrase;
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
        $push = FCM::notificationTitle('New catchphrase');
//        $push->notificationBody($this->message->text);

        $push->data([
            'router' => json_encode([
                'name'   => 'feed-profile-catchphrases',
                'params' => [
                    'userId'        => $this->catchphrase->user->id,
                    'catchphraseId' => $this->catchphrase->id
                ]
            ])
        ]);

        return $push;
    }
}
