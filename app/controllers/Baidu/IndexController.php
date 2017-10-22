<?php

namespace App\Controllers\Baidu;

use App\Controllers\AuthController;
use App\Models\UserBaidu;
use App\Support\Validation\TiebaSaveValidator;

class IndexController extends AuthController
{
    public function indexAction()
    {
        $user_id = $this->user->id;
        $res = UserBaidu::find([
            'conditions' => 'user_id=?0',
            'bind' => [$user_id]
        ]);
        return static::success($res);
    }

    public function saveAction()
    {
        $data = $this->request->get();
        $validator = new TiebaSaveValidator();
        if ($validator->validate($data)->valid()) {
            return static::error($validator->getErrorMessage());
        }

        $nickname = $this->request->get('nickname');
        $bd_uss = $this->request->get('bd_uss');

        $model = new UserBaidu();
        $model->tb_nickname = $nickname;
        $model->bd_uss = $bd_uss;
        $model->user_id = $this->user->id;

        if ($model->save()) {
            return static::success();
        }
        return static::error("授权信息保存失败！");
    }


}

