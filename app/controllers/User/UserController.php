<?php

namespace App\Controllers\User;

use App\Controllers\AuthController;
use App\Models\User;
use App\Support\User\Login;

class UserController extends AuthController
{

    public function infoAction()
    {
        return static::success($this->user);
    }

    public function saveAction()
    {
        $nickname = $this->request->get('nickname');
        $avatar = $this->request->get('avatar');

        $id = $this->user->id;
        $user = User::findFirst($id);
        if ($nickname) {
            $user->nickname = $nickname;
        }
        if ($avatar) {
            $user->avatar = $avatar;
        }

        if (!$user->save()) {
            return static::error("保存失败");
        }

        Login::fresh($this->token);
        return static::success();
    }

}

