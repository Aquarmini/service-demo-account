<?php

namespace App\Controllers\Baidu;

use App\Controllers\Controller;
use App\Utils\Redis;

class TiebaController extends Controller
{

    public function indexAction()
    {
        $json = Redis::hget(env('REGISTER_CENTER_SERVICE_LIST_KEY'), 'baidu');
        if ($config = json_decode($json, true)) {
            // $tieba =
        }
        return static::success([]);
    }

}

