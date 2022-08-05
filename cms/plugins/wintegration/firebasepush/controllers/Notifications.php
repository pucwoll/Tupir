<?php namespace WIntegration\FireBasePush\Controllers;

use Exception;
use RainLab\User\Models\User;
use Backend\Classes\Controller;
use October\Rain\Support\Facades\Flash;
use Illuminate\Support\Facades\Notification;
use WIntegration\FireBasePush\Classes\Notifications\CMSNotification;

class Notifications extends Controller
{
    public function index()
    {

    }


    public function index_onSend()
    {
        $header = input('header', '');
        $body = input('body', '');
        $router = input('router', '');
        $externalUrl = input('externalUrl', '');

        try {
            User::all()->each(function ($user) use ($header, $body, $router, $externalUrl) {
                Notification::send($user, new CMSNotification($header, $body, $router, $externalUrl));
            });
            Flash::success('Successfully sent');
        } catch (Exception $exception) {
            Flash::error($exception->getMessage());
        }
    }
}
