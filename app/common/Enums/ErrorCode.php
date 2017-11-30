<?php
// +----------------------------------------------------------------------
// | ErrorCode.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Enums;

use Xin\Phalcon\Enum\Enum;

class ErrorCode extends Enum
{
    /**
     * @Message('系统错误')
     */
    public static $ENUM_SYSTEM_ERROR = 400;

    /**
     * @Message('服务器错误')
     */
    public static $ENUM_SERVER_ERROR = 500;

    /**
     * @Message('参数错误')
     */
    public static $ENUM_PARAMS_ERROR = 600;

    /**
     * @Message('Token 必传')
     */
    public static $ENUM_TOKEN_IS_REQUIRED = 601;

    /**
     * @Message('Token已失效，请重新登录')
     */
    public static $ENUM_TOKEN_EXPIRED = 700;
}