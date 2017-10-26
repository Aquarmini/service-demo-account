<?php
// +----------------------------------------------------------------------
// | AppHandler.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Thrift\Services;

use App\Models\User;
use Xin\Thrift\Account\AccountIf;

class AccountHandler extends Handler implements AccountIf
{
    public function login($username, $password)
    {
        $user = User::findFirst([
            'conditions' => 'username = ?0',
            'bind' => [$username]
        ]);


    }

    public function user($token)
    {
        // TODO: Implement user() method.
    }

}