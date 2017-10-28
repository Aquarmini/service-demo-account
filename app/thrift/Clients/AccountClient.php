<?php

namespace App\Thrift\Clients;

use App\Thrift\Client;

class AccountClient extends Client
{
    protected $host = '127.0.0.1';

    protected $port = '52101';

    protected $service = 'account';

    protected $clientName = \Xin\Thrift\Account\AccountClient::class;

    protected $recvTimeoutMilliseconds = 50;

    protected $sendTimeoutMilliseconds;

    /**
     * @desc
     * @author limx
     * @param array $config
     * @return \Xin\Thrift\Account\AccountClient
     */
    public static function getInstance($config = [])
    {
        return parent::getInstance($config);
    }

}

