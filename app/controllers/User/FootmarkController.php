<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Models\Footmark;
use App\Support\Validation\FootmarkSaveValidator;

class FootmarkController extends Controller
{

    public function indexAction()
    {

    }

    public function saveAction()
    {
        $data = $this->request->get();
        $validator = new FootmarkSaveValidator();
        if ($validator->validate($data)->valid()) {
            return static::error($validator->getErrorMessage());
        }
        return static::success();
    }

    public function nearAction()
    {

    }

}

