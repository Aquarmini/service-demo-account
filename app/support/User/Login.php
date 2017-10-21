<?php
// +----------------------------------------------------------------------
// | Login.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Support\User;

use App\Models\User;
use App\Utils\Redis;

class Login
{
    public static $prefix = 'login:';

    public static function login($token, User $user, $time = 3600)
    {
        Redis::set(static::$prefix . $token, serialize($user));
        Redis::expire(static::$prefix . $token, $time);
        return true;
    }

    public static function logout($token)
    {
        Redis::del(static::$prefix . $token);
        return true;
    }

    public static function user($token, $time = 3600)
    {
        $user = Redis::get(static::$prefix . $token);
        if (empty($user)) {
            return null;
        }
        $user = unserialize($user);
        if ($user instanceof User) {
            Redis::expire(static::$prefix . $token, $time);
            return $user;
        }
        return null;
    }
}