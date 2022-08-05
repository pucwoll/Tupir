<?php namespace WIntegration\FirebasePush\Classes;

use Plokko\Firebase\FCM\Exceptions\FcmErrorException;
use Plokko\Firebase\FCM\Message as MessageBase;
use Plokko\Firebase\FCM\Message\AndroidConfig;
use Plokko\Firebase\FCM\Message\Data;
use Plokko\Firebase\FCM\Message\WebpushConfig;
use Plokko\Firebase\FCM\Request;
use Plokko\Firebase\FCM\Targets\Target;
use WIntegration\FirebasePush\Classes\Message\ApnsConfig;
use WIntegration\FirebasePush\Classes\Message\Notification;

class Message extends MessageBase
{
    private
        /**@var string* */
        $name,
        /**@var \Plokko\Firebase\FCM\Message\Data * */
        $data,
        /**@var \WIntegration\FirebasePush\Classes\Message\Notification * */
        $notification,
        /**@var \Plokko\Firebase\FCM\Message\AndroidConfig * */
        $android,
        /**@var \Plokko\Firebase\FCM\Message\WebpushConfig * */
        $webpush,
        /**@var \WIntegration\FirebasePush\Classes\Message\ApnsConfig * */
        $apns,

        /**@var \Plokko\Firebase\FCM\Targets\Target * */
        $target;

    function __construct()
    {
    }

    function __get($name)
    {
        if (!$this->{$name}) {
            //Lazy creation
            switch ($name) {
                case 'data':
                    $this->data = new Data();
                    break;
                case 'notification':
                    $this->notification = new Notification();
                    break;
                case 'android':
                    $this->android = new AndroidConfig();
                    break;
                case 'webpush':
                    $this->webpush = new WebpushConfig();
                    break;
                case 'apns':
                    $this->apns = new ApnsConfig();
                    break;
                default:
            }
        }
        return $this->{$name};
    }

    function __set($k, $v)
    {
        switch ($k) {
            case 'data':
                $this->data = $v == null || $v instanceof Data ? $v : new Data($v);
                return;
            case 'notification':
                if ($v !== null && !$v instanceof Notification) {
                    break;
                }
                $this->notification = $v;
                return;
            case 'android':
                if ($v !== null && !$v instanceof AndroidConfig) {
                    break;
                }
                $this->android = $v;
                return;
            case 'webpush':
                if ($v !== null && !$v instanceof WebpushConfig) {
                    break;
                }
                $this->webpush = $v;
                return;
            case 'apns':
                if ($v !== null && !$v instanceof ApnsConfig) {
                    break;
                }
                $this->apns = $v;
                return;
            case 'target':
                if ($v !== null && !$v instanceof Target) {
                    break;
                }
                $this->target = $v;
                return;
            default:

        }
        throw new \UnexpectedValueException('Invalid value type for propriety '.$k);
    }

    function setTarget(Target $target)
    {
        $this->target = $target;
    }


    function getPayload()
    {
        if (!$this->target) {
            throw new \UnexpectedValueException('FCMMEssage target not specified!', 'TARGET_NOT_SPECIFIED');
        }

        $data = array_filter([
            'data' => $this->data,
            'notification' => $this->notification,
            'android' => $this->android,
            'webpush' => $this->webpush,
            'apns' => $this->apns,
        ]);
        return array_merge($data, $this->target->jsonSerialize());
    }

    /**
     * Submit the message
     * @param  Request  $request
     * @throws FcmErrorException
     * @throws GuzzleException
     */
    public function send(Request $request)
    {
        $name = $request->submit($this);
        if (!$request->validate_only) {
            $this->name = $name;
        }
    }

    /**
     * Validate the message with Firebase without submitting it
     * @param  Request  $request
     * @return bool
     * @throws GuzzleException
     * @throws FcmErrorException
     */
    public function validate(Request $request)
    {
        $request = clone $request;
        $request->validate_only = true;

        $request->submit($this);

        return true;
    }

    public function jsonSerialize()
    {
        $data = array_filter([
            'name' => $this->name,
            'data' => $this->data,
            'notification' => $this->notification,
            'android' => $this->android,
            'webpush' => $this->webpush,
            'apns' => $this->apns,
        ]);

        return $this->target ? array_merge($data, $this->target->jsonSerialize()) : $data;
    }

    function __toString()
    {
        return json_encode($this);
    }

    /**
     * Tells if the request was already submitted (if it has an id)
     * @return bool
     */
    function isSubmitted()
    {
        return !!$this->name;
    }
}
