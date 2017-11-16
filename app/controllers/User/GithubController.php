<?php

namespace App\Controllers\User;

use App\Controllers\AuthController;
use App\Biz\User\Github;
use App\Support\Validation\GithubUserValidator;
use Exception;

class GithubController extends AuthController
{

    public function userAction()
    {
        $data = $this->request->get();
        $validator = new GithubUserValidator();
        if ($validator->validate($data)->valid()) {
            return static::error($validator->getErrorMessage());
        }

        $user_id = $this->user->id;
        $name = $this->request->get('name');

        try {
            $user = Github::getInstance()->user($user_id, $name);
            return static::success($user);
        } catch (Exception $ex) {
            return static::error($ex->getMessage());
        }
    }

    public function refreshAction()
    {
        $data = $this->request->get();
        $validator = new GithubUserValidator();
        if ($validator->validate($data)->valid()) {
            return $validator->getErrorMessage();
        }

        $user_id = $this->user->id;
        $name = $this->request->get('name');

        try {
            if (!Github::getInstance()->refresh($user_id, $name)) {
                return static::error('数据刷新失败！');
            }

        } catch (Exception $ex) {
            return static::error($ex->getMessage());
        }
        return static::success();
    }

}

