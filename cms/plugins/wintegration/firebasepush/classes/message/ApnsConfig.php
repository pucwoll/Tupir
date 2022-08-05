<?php namespace WIntegration\FirebasePush\Classes\Message;

use JsonSerializable;
use WIntegration\FirebasePush\Classes\Message\Apns\ApnsPayload;
use WIntegration\FirebasePush\Classes\Message\Apns\FcmOptions;

class ApnsConfig implements JsonSerializable
{
    private
        /**
         * @var array HTTP request headers defined in Apple Push Notification Service. Refer to APNs request headers for supported headers, e.g. "apns-priority": "10".
         * @see https://goo.gl/C6Yhia
         **/
        $headers = [],

        /** @var ApnsPayload * */
        $payload,

        /** @var FcmOptions * */
        $fcm_options;

    /**
     * @param  array  $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    function __get($k)
    {
        if ($k === 'payload') {
            if (!$this->payload) {
                $this->payload = new ApnsPayload();
            }
        } else {
            if ($k === 'fcm_options') {
                if (!$this->fcm_options) {
                    $this->fcm_options = new FcmOptions();
                }
            }
        }

        return $this->{$k};
    }

    function __set($k, $v)
    {
        $this->{$k} = $v;
    }

    public function jsonSerialize()
    {
        return array_filter([
            'headers' => $this->headers,
            'payload' => $this->payload,
            'fcm_options' => $this->fcm_options,
        ]);
    }
}
