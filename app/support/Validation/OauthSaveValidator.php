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
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\PresenceOf;

class OauthSaveValidator extends Validator
{
    public function initialize()
    {
        $this->add([
            'name',
            'type',
            'code'
        ], new PresenceOf([
            'message' => '参数 :field 不能为空'
        ]));

        $this->add([
            'type',
        ], new InclusionIn([
            'message' => '参数 :field 不合法',
            'domain' => [
                'type' => [0, 1, 2]
            ],
        ]));
    }

}