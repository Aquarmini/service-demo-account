<?php
// +----------------------------------------------------------------------
// | common.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------

if (!function_exists('password')) {

    /**
     * @desc   铭文密码转为密文密码
     * @author limx
     * @param $password
     * @return mixed
     */
    function password($password)
    {
        return md5('account' . md5($password) . 'password');
    }
}