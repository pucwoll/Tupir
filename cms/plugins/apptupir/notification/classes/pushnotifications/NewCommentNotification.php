<?php namespace AppTupir\Notification\Classes\PushNotifications;

use LibChat\Comments\Models\Comment;
use Plokko\LaravelFirebase\Facades\FCM;
use Illuminate\Notifications\Notification;
use WIntegration\FireBasePush\Classes\Channels\FirebasePushChannel;

class NewCommentNotification extends Notification
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
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
        $push = FCM::notificationTitle('New comment');
//        $push->notificationBody($this->message->text);

        $push->data([
            'router' => json_encode([
                'path' => "/catchphrase/{$this->comment->commentable->id}",
                'params' => [
                    'showComments' => true
                ]
            ])
        ]);

        return $push;
    }
}
