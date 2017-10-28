<?php
// +----------------------------------------------------------------------
// | AppHandler.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Thrift\Services;

use App\Logics\User;
use App\Support\User\Login;
use Xin\Thrift\Account\AccountIf;
use Xin\Thrift\Account\LoginResponse;
use Xin\Thrift\Account\User as AccountUser;

class AccountHandler extends Handler implements AccountIf
{
    public function login($username, $password)
    {
        list($status, $data) = User::login($username, $password);
        $result = new LoginResponse();
        if (!$status) {
            $result->success = false;
            return $result;
        }
        /** @var string $token */
        $token = $data['token'];
        /** @var \App\Models\User $user */
        $user = $data['user'];

        if (empty($token) || !($user instanceof \App\Models\User)) {
            $result->success = false;
            return $result;
        }

        $result->user = new AccountUser($user->toArray());
        $result->token = $token;
        return $result;
    }

    public function user($token)
    {
        $user = Login::user($token);
        echo $token . PHP_EOL;
        return new AccountUser($user->toArray());
    }

}