<?php

namespace App\Controllers\User;

use App\Controllers\AuthController;
use App\Models\UserOauth;

class OauthController extends AuthController
{

    public function listAction()
    {
        $list = UserOauth::find([
            'conditions' => 'user_id = ?0',
            'bind' => [$this->user->id]
        ]);
        $result = [];
        foreach ($list as $v) {
            $item = $v->toArray();
            $item['type_name'] = oauth_type_to_name($v->type);
            $result[] = $item;
        }
        return static::success($result);
    }

    public function saveAction()
    {
        return static::error('功能未开发');
    }

}

