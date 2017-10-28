<?php

namespace App\Tasks\Test;

use App\Tasks\Task;
use App\Thrift\Clients\AccountClient;

class AccountTask extends Task
{

    public function loginAction()
    {
        $client = AccountClient::getInstance();
        $res = $client->login('test', '000000');
        $res = $client->user($res->token);
        dd($res);
    }

}

