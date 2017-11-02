<?php
// +----------------------------------------------------------------------
// | AuthMiddleware.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Middleware;

use App\Controllers\Traits\Response;
use Closure;
use Xin\Phalcon\Middleware\Middleware;
use App\Support\User\Login;

class UserAuthMiddleware extends Middleware
{
    use Response;

    public function handle($request, Closure $next)
    {
        $token = $this->request->get('token');
        if (empty($token)) {
            return static::error("Token 必传", [], 500);
        }

        $user = Login::user($token);
        if (empty($user)) {
            return static::error("登录已失效，请重新登录", [], 700);
        }

        return $next($request);
    }
}