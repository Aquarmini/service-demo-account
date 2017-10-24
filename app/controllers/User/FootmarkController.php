<?php

namespace App\Controllers\User;

use App\Controllers\AuthController;
use App\Models\Footmark;
use App\Support\Common\Elasticsearch\Impl\FootmarkImpl;
use App\Support\Validation\FootmarkSaveValidator;
use App\Support\Validation\NearValidator;

class FootmarkController extends AuthController
{

    public function indexAction()
    {
        $list = Footmark::find([
            'conditions' => 'user_id = ?0',
            'bind' => [$this->user->id],
            'order' => 'id DESC',
            'limit' => 10,
        ]);
        return static::success($list);
    }

    public function saveAction()
    {
        $data = $this->request->get();
        $validator = new FootmarkSaveValidator();
        if ($validator->validate($data)->valid()) {
            return static::error($validator->getErrorMessage());
        }

        $image = $this->request->get('image');
        $message = $this->request->get('message');
        $lat = $this->request->get('lat');
        $lon = $this->request->get('lon');

        $model = new Footmark();
        $model->user_id = $this->user->id;
        $model->image = $image;
        $model->message = $message;
        $model->lat = $lat;
        $model->lon = $lon;

        if (!$model->save()) {
            return static::error('足迹保存失败！');
        }

        return static::success();
    }

    public function nearAction()
    {
        $data = $this->request->get();
        $validator = new NearValidator();
        if ($validator->validate($data)->valid()) {
            return static::error($validator->getErrorMessage());
        }

        $lat = $this->request->get('lat');
        $lon = $this->request->get('lon');

        $res = FootmarkImpl::near($lon, $lat);
        // $res = FootmarkImpl::get(9);
        return static::success($res);
    }

}

