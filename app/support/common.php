<?php
// +----------------------------------------------------------------------
// | common.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
use App\Sys;

if (!function_exists('password')) {

    /**
     * @desc   明文密码转为密文密码
     * @author limx
     * @param $password
     * @return mixed
     */
    function password($password)
    {
        return md5('account' . md5($password) . 'password');
    }
}

if (!function_exists('oauth_type_to_name')) {

    /**
     * @desc   授权类型转为化名称
     * @author limx
     * @param $type
     * @return mixed
     */
    function oauth_type_to_name($type)
    {
        switch ($type) {
            case Sys::OAUTH_TYPE_EMAIL:
                return '邮件';
            case Sys::OAUTH_TYPE_MOBILE:
                return '手机号';
            case Sys::OAUTH_TYPE_GITHUB:
                return 'Github';
            default:
                return '未知';
        }
    }
}