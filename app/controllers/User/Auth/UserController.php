<?php

namespace App\Controllers\User\Auth;

class UserController extends Controller
{

    public function infoAction()
    {
        return static::success($this->user);
    }

}

