<?php namespace WIntegration\FireBasePush\Classes\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class FirebasePushChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toFirebasePush($notifiable);

        $devices = $notifiable->devices()->get();
        foreach ($devices as $device) {
            $deviceMessage = clone $message;
			$deviceMessage->notificationEnableSound();
            $deviceMessage->toDevice($device->token);

            try {
                $deviceMessage->send();
            } catch (\Exception $exception) {
                if ($exception->getCode() === '404') {
                    $device->delete();
                } else {
                    $error = implode(PHP_EOL, [
                        vsprintf('PUSH NOTIFICATION FAILURE -> USER: %d -> %s -> %s', [
                            $device->user_id,
                            $exception->getCode(),
                            $exception->getMessage()
                        ]),
                        'TOKEN: ' . $device->token,
                        'ERROR: ', json_encode($exception, JSON_PRETTY_PRINT)
                    ]);
                    Log::error($error);
                }
            }
        }
    }
}
