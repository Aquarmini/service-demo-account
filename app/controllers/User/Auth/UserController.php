<?php

namespace App\Controllers\User\Auth;

use App\Models\User;
use App\Support\User\Login;

class UserController extends Controller
{

    public function infoAction()
    {
        return static::success($this->user);
    }

    public function saveAction()
    {
        $nickname = $this->request->get('nickname');


        $id = $this->user->id;
        $user = User::findFirst($id);
        if ($nickname) {
            $user->nickname = $nickname;
        }

        if (!$user->save()) {
            return static::error("保存失败");
        }

        Login::fresh($this->token);
        return static::success();
    }

}

