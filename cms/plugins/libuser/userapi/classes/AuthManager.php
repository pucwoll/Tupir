<?php namespace LibUser\UserApi\Classes;

use LibUser\UserApi\Models\User;
use RainLab\User\Classes\AuthManager as AuthManagerBase;

class AuthManager extends AuthManagerBase
{
    protected $userModel = User::class;
}
