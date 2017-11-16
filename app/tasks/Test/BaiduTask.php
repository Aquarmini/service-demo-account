<?php

namespace App\Tasks\Test;

use App\Tasks\Task;
use App\Thrift\Clients\BaiduClient;
use App\Utils\Redis;

class BaiduTask extends Task
{

    public function tiebaListAction()
    {
        $client = BaiduClient::getInstance();
        $res = $client->tiebaList('桃园丶龙玉箫');
        dd($res);

    }

}

