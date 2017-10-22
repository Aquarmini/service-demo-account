<?php
// +----------------------------------------------------------------------
// | Store.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Support\Common;

use App\Support\Common\Store\StoreInterface;
use limx\Support\Str;
use Phalcon\Text;

class Store
{
    public static $_instance;

    /**
     * @desc
     * @author limx
     * @return StoreInterface
     */
    public static function getInstance()
    {
        if (isset(static::$_instance) && static::$_instance instanceof StoreInterface) {
            return static::$_instance;
        }

        $config = di('app')->store;
        $engine = $config->engine;
        $className = '\\App\\Support\\Common\\Store\\' . Text::camelize($engine);

        return static::$_instance = new $className();
    }
}