<?php
// +----------------------------------------------------------------------
// | LoginValidator.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Support\Validation;

use App\Core\Validation\Validator;
use Phalcon\Validation\Validator\NumericValidator;
use Phalcon\Validation\Validator\PresenceOf;

class FootmarkSaveValidator extends Validator
{
    public function initialize()
    {
        $this->add([
            'image',
            'message',
            'lon',
            'lat'
        ], new PresenceOf([
            'message' => '参数 :field 不能为空'
        ]));

        $this->add([
            'lon',
            'lat',
        ], new NumericValidator([
            'message' => '经纬度必须为数字',
            'allowFloat' => true,
        ]));
    }

}