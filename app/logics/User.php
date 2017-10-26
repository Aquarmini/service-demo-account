<?php

namespace App\Logics;

use App\Models\User as UserModel;
use App\Support\User\Login;
use limx\Support\Str;

class User extends Base
{
    /**
     * @desc   登录接口
     * @author limx
     * @param $username
     * @param $passowrd
     */
    public static function login($username, $password)
    {
        $user = UserModel::findFirst([
            'conditions' => 'username = ?0',
            'bind' => [$username]
        ]);

        if (empty($user)) {
            // 新建账号
            $user = new UserModel();
            $user->username = $username;
            $user->password = password($password);

            if ($user->save() === false) {
                return [false, "账号新建失败！"];
            }
        }

        if ($user->password === password($password)) {
            // 登录
            $token = $user->id . ":" . Str::random(32);
            Login::login($token, $user);
            $result = [
                'token' => $token,
                'user' => $user
            ];
            return [true, $result];
        }
        return [false, "密码错误！"];
    }
}

