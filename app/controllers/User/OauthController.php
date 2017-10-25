<?php

namespace App\Controllers\User;

use App\Controllers\AuthController;
use App\Models\UserOauth;
use App\Support\Validation\OauthSaveValidator;

class OauthController extends AuthController
{

    public function listAction()
    {
        $list = UserOauth::find([
            'conditions' => 'user_id = ?0',
            'bind' => [$this->user->id]
        ]);
        $result = [];
        foreach ($list as $v) {
            $item = $v->toArray();
            $item['type_name'] = oauth_type_to_name($v->type);
            $result[] = $item;
        }
        return static::success($result);
    }

    public function saveAction()
    {
        $data = $this->request->get();
        $validator = new OauthSaveValidator();
        if ($validator->validate($data)->valid()) {
            return static::error($validator->getErrorMessage());
        }

        $code = $this->request->get('code');
        $name = $this->request->get('name');
        $type = $this->request->get('type');

        $model = new UserOauth();
        $model->user_id = $this->user->id;
        $model->type = $type;
        $model->name = $name;
        $model->code = $code;
        if (!$model->save()) {
            return static::error('授权信息保存失败！');
        }

        return static::success();
    }

}

