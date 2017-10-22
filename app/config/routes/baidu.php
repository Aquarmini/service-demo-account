<?php
// +----------------------------------------------------------------------
// | baidu.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------

// 贴吧列表
$router->add('/baidu/tieba/list', 'App\\Controllers\\Baidu\\Tieba::index');
// 保存贴吧授权信息
$router->add('/baidu/tieba/save', 'App\\Controllers\\Baidu\\Index::save');
// 贴吧授权信息列表
$router->add('/baidu/tieba/user/list', 'App\\Controllers\\Baidu\\Index::index');

