<?php
// +----------------------------------------------------------------------
// | Footmark.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Support\Common\Elasticsearch\Impl;

use App\Models\Footmark;
use App\Support\Common\Elasticsearch\Client;
use App\Utils\Log;
use Exception;

class FootmarkImpl
{
    public static function create(Footmark $model)
    {
        $client = Client::getInstance();
        $config = di('app')->es->footmark;
        $params = [
            'index' => $config->index,
            'type' => $config->type,
            'id' => $model->id,
            'body' => [
                'id' => $model->id,
                'user_id' => $model->user_id,
                'image' => $model->image,
                'message' => $model->message,
                'location' => [
                    'lat' => $model->lat,
                    'lon' => $model->lon
                ],
            ]
        ];
        Log::info("es:footmark@creating[$model->id]" . json_encode($params, JSON_UNESCAPED_UNICODE));
        try {
            $res = $client->index($params);
        } catch (Exception $ex) {
            Log::info("es:footmark@creatfail[$model->id]" . $ex->getMessage());
            return false;
        }
        Log::info("es:footmark@created[$model->id]" . json_encode($res, JSON_UNESCAPED_UNICODE));
        return $res['created'];
    }

    public static function update(Footmark $model)
    {
        $client = Client::getInstance();
        $config = di('app')->es->footmark;
        $params = [
            'index' => $config->index,
            'type' => $config->type,
            'id' => $model->id,
            'body' => [
                'id' => $model->id,
                'user_id' => $model->user_id,
                'image' => $model->image,
                'message' => $model->message,
                'location' => [
                    'lat' => $model->lat,
                    'lon' => $model->lon
                ],
            ]
        ];
        Log::info("es:footmark@updating[$model->id]" . json_encode($params, JSON_UNESCAPED_UNICODE));
        try {
            $res = $client->index($params);
        } catch (Exception $ex) {
            Log::info("es:footmark@updatefail[$model->id]" . $ex->getMessage());
            return false;
        }
        Log::info("es:footmark@updated[$model->id]" . json_encode($res, JSON_UNESCAPED_UNICODE));
        return $res['created'];
    }

    public static function get($id)
    {
        $client = Client::getInstance();
        $config = di('app')->es->footmark;
        $params = [
            'index' => $config->index,
            'type' => $config->type,
            'id' => $id,
        ];
        try {
            $res = $client->getSource($params);
        } catch (Exception $ex) {
            return [];
        }
        return $res;
    }

}