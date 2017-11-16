<?php

namespace App\Controllers\Baidu;

use App\Controllers\AuthController;
use App\Models\UserBaidu;
use App\Thrift\Clients\BaiduClient;
use App\Utils\Redis;

class TiebaController extends AuthController
{

    public function indexAction()
    {
        $user_baidu_id = $this->request->get('user_baidu_id');
        if ($user_baidu_id) {
            $userBaidu = UserBaidu::findFirst($user_baidu_id);

            $client = BaiduClient::getInstance();
            $res = $client->tiebaList($userBaidu->tb_nickname);

            return static::success($res);
        }
        return static::success([]);
    }

}

