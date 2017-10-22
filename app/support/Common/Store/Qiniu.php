<?php
// +----------------------------------------------------------------------
// | Qiniu.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------

namespace App\Support\Common\Store;

use App\Support\Common\Store\Exceptions\UploadException;
use limx\Support\Str;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class Qiniu implements StoreInterface
{
    public $key;

    public function upload($file)
    {
        $accessKey = di('app')->store->qiniu->accessKey;
        $secretKey = di('app')->store->qiniu->secretKey;
        // 初始化签权对象
        $auth = new Auth($accessKey, $secretKey);

        $bucket = di('app')->store->qiniu->bucketName;
        // 生成上传Token
        $token = $auth->uploadToken($bucket);

        // 构建 UploadManager 对象
        $uploadMgr = new UploadManager();

        $name = date('Ymd') . '/' . Str::random(16);
        list($res, $err) = $uploadMgr->putFile($token, $name, $file);
        if ($err) {
            throw new UploadException($err);
        }

        $this->key = $res['key'];

        return $res;
    }

    public function getUploadFileUrl()
    {
        $base_url = di('app')->store->qiniu->baseUrl;
        if (!isset($this->key)) {
            throw new UploadException("上传失败");
        }
        return $base_url . '/' . $this->key;
    }

}