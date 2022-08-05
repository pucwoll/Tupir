<?php namespace WIntegration\FirebasePush\Classes\Message;

use Plokko\Firebase\FCM\Message\Notification as NotificationBase;

class Notification extends NotificationBase
{
    public $image;

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'image' => $this->image
        ];
    }
}
