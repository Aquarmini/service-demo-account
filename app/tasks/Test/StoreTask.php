<?php

namespace App\Tasks\Test;

use App\Support\Common\Store;
use App\Tasks\Task;

class StoreTask extends Task
{

    public function mainAction()
    {
        $file = ROOT_PATH . '/public/static/images/logo.png';
        $store = Store::getInstance();
        $res = $store->upload($file);
        dd($res);
    }

}

