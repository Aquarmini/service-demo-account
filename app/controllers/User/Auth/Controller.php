<?php
// +----------------------------------------------------------------------
// | Controller.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Controllers\User\Auth;

use App\Controllers\Controller as BaseController;
use App\Support\User\Login;

class Controller extends BaseController
{

    public function beforeExecuteRoute()
    {
        // 在每一个找到的动作前执行
        $token = $this->request->get('token');
        if (empty($token)) {
            return $this->dispatcher->forward([
                'namespace' => 'App\Controllers',
                "controller" => "Error",
                "action" => "json",
                'params' => [500, "Token 必传"],
            ]);
        }

        $user = Login::user($token);
        if (empty($user)) {
            return $this->dispatcher->forward([
                'namespace' => 'App\Controllers',
                "controller" => "Error",
                "action" => "json",
                'params' => [700, "登录已失效，请重新登录"],
            ]);
        }

        $this->user = $user;
        $this->token = $token;
    }


}