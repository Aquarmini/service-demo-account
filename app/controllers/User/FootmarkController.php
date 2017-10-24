<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Models\Footmark;
use App\Support\Common\Elasticsearch\Impl\FootmarkImpl;
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

        $image = $this->request->get('image');
        $message = $this->request->get('message');
        $lat = $this->request->get('lat');
        $lon = $this->request->get('lon');

        $model = new Footmark();
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

    }

}

