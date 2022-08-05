<?php namespace AppTupir\Notification\Classes\PushNotifications;

use Plokko\LaravelFirebase\Facades\FCM;
use Illuminate\Notifications\Notification;
use WIntegration\FireBasePush\Classes\Channels\FirebasePushChannel;

class NewFollowersNotification extends Notification
{
    protected $text;

    public function __construct($user)
    {
        $this->text = $user->name . " just started following you!";
    }

    public function via($notifiable)
    {
        return [
            FirebasePushChannel::class,
        ];
    }

    public function toFirebasePush($notifiable)
    {
        $push = FCM::notificationTitle('New follower');
        $push->notificationBody($this->text);

        $push->data([
            'router' => json_encode([
                'path' => '/my-profile',
            ])
        ]);

        return $push;
    }
}
