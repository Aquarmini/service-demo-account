<?php
// +----------------------------------------------------------------------
// | Client.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------

namespace App\Support\Common\Elasticsearch;

use Elasticsearch\ClientBuilder;
use Elasticsearch\Client as EClient;

class Client
{
    public static $_instance;

    /**
     * @desc
     * @author limx
     * @return EClient
     */
    public static function getInstance()
    {
        if (isset(static::$_instance) && static::$_instance instanceof EClient) {
            return static::$_instance;
        }

        $config = di('app')->es;
        $client = ClientBuilder::create()
            ->setHosts($config->host->toArray())
            ->build();

        return static::$_instance = $client;
    }
}