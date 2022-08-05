<?php namespace WIntegration\FirebasePush\Classes\Message\Apns;

use JsonSerializable;

class FcmOptions implements JsonSerializable
{
    public
        /**@var string The notification's image. */
        $image;

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'image' => $this->image,
        ];
    }
}
