<?php

namespace App\Controllers\User;

use App\Controllers\AuthController;
use App\Models\Weight;
use App\Support\Validation\WeightAddValidator;

class WeightController extends AuthController
{

    public function indexAction()
    {
        $list = Weight::find([
            'conditions' => 'user_id = ?0',
            'bind' => [$this->user->id],
            'order' => 'date DESC',
            'limit' => 30,
        ]);

        return static::success($list);
    }

    public function addAction()
    {
        $data = $this->request->get();
        $validator = new WeightAddValidator();
        if ($validator->validate($data)->valid()) {
            return static::error($validator->getErrorMessage());
        }

        $today = date('Y-m-d');
        $date = $this->request->get('date', null, $today);
        $weight = $this->request->get('weight');

        $item = Weight::findFirst([
            'conditions' => 'user_id = ?0 AND date = ?1',
            'bind' => [$this->user->id, $date]
        ]);

        if (empty($item)) {
            $item = new Weight();
            $item->user_id = $this->user->id;
            $item->date = $date;
        }

        $item->weight = $weight;
        if (!$item->save()) {
            return static::error('数据保存失败');
        }

        return static::success();
    }

}

