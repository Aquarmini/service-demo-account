<?php

namespace App\Controllers\Common;

use App\Controllers\Controller;
use App\Support\Common\Store;
use limx\Support\Str;

class ImageController extends Controller
{

    public function uploadAction()
    {
        $files = $this->request->getUploadedFiles();
        if (count($files) == 0) {
            return static::error('请上传图片');
        }
        $file = $files[0];
        $dir = ROOT_PATH . '/public';
        $target = '/upload/' . date('Ymd') . Str::random(16) . '.' . $file->getExtension();
        if ($file->moveTo($dir . $target)) {
            $store = Store::getInstance();
            $store->upload($dir . $target);
            return static::success([
                'image' => $store->getUploadFileUrl()
            ]);
        }
        return static::error('图片上传失败');
    }

    public function getUploadImage($target)
    {
        return 'http://account.service.limx0536.cn' . $target;
    }

}

