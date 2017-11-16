<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Biz\User;
use App\Support\User\Login;
use App\Support\Validation\LoginValidator;
use limx\Support\Str;

class LoginController extends Controller
{
    public function indexAction()
    {
        $data = $this->request->get();
        $validator = new LoginValidator();
        if ($validator->validate($data)->valid()) {
            return static::error($validator->getErrorMessage());
        }

        $username = $this->request->get('username');
        $password = $this->request->get('password');

        list($status, $data) = User::getInstance()->login($username, $password);
        if ($status) {
            return static::success($data);
        }

        return static::error($data);
    }

}

