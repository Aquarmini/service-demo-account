<?php

namespace App\Tasks\Test;

use App\Tasks\Task;
use App\Thrift\Clients\BaiduClient;
use App\Utils\Redis;

class BaiduTask extends Task
{

    public function tiebaListAction()
    {
        $redis_key = di('config')->thrift->service->listKey;
        $json = Redis::hget($redis_key, 'baidu');
        if ($config = json_decode($json, true)) {

            $client = BaiduClient::getInstance([
                'host' => $config['host'],
                'port' => $config['port']
            ]);
            $res = $client->tiebaList('桃园丶龙玉箫');
            dd($res);
        }
    }

}

