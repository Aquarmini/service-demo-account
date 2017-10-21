<?php
// +----------------------------------------------------------------------
// | user.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------

// 用户登录
$router->add('/user/login', 'App\\Controllers\\User\\Login::index');
// 用户信息
$router->add('/user/info', 'App\\Controllers\\User\\Auth\\User::info');
// 保存信息
$router->add('/user/save', 'App\\Controllers\\User\\Auth\\User::save');