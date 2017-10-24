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
use Xin\Phalcon\Logger\Factory;

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
        static::logger()->info("es:footmark@creating[$model->id]" . json_encode($params, JSON_UNESCAPED_UNICODE));
        try {
            $res = $client->index($params);
        } catch (Exception $ex) {
            static::logger()->info("es:footmark@creatfail[$model->id]" . $ex->getMessage());
            return false;
        }
        static::logger()->info("es:footmark@created[$model->id]" . json_encode($res, JSON_UNESCAPED_UNICODE));
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
        static::logger()->info("es:footmark@updating[$model->id]" . json_encode($params, JSON_UNESCAPED_UNICODE));
        try {
            $res = $client->index($params);
        } catch (Exception $ex) {
            static::logger()->info("es:footmark@updatefail[$model->id]" . $ex->getMessage());
            return false;
        }
        static::logger()->info("es:footmark@updated[$model->id]" . json_encode($res, JSON_UNESCAPED_UNICODE));
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

    public static function near($lon, $lat)
    {
        $client = Client::getInstance();
        $config = di('app')->es->footmark;
        $params = [
            'index' => $config->index,
            'type' => $config->type,
            'body' => [
                'query' => [
                    'bool' => [
                        'filter' => [
                            'geo_distance' => [
                                'distance' => '10km',
                                'location' => [
                                    'lat' => $lat,
                                    'lon' => $lon
                                ],
                            ],
                        ],
                    ],
                ],
                'from' => 0,
                'size' => 10,
                'sort' => [
                    '_geo_distance' => [
                        'location' => [
                            'lat' => $lat,
                            'lon' => $lon
                        ],
                        'order' => 'asc',
                        'unit' => 'km',
                        'mode' => 'min',
                    ],
                ],
            ],
        ];

        $result = [];
        try {
            $res = $client->search($params);
            if (isset($res['hits'])) {
                // 存在命中的数据
                $total = $res['hits']['total'];
                $items = [];
                foreach ($res['hits']['hits'] as $hit) {
                    $item = $hit['_source'];
                    $item['distance'] = round($hit['sort'][0], 3) . 'km';
                    $items[] = $item;
                }
                $result['total'] = $total;
                $result['items'] = $items;
            }
            Log::debug(json_encode($res));
        } catch (\Exception $ex) {
            $res = json_decode($ex->getMessage(), true);
            if ($res) {
                Log::error('es:search:' . $res['error']['reason']);
            } else {
                Log::error('es:search:' . $ex->getMessage());
            }
            return [];
        }

        return $result;
    }

    public static function logger()
    {
        /** @var Factory $factory */
        $factory = di('logger');
        return $factory->getLogger('elasticsearch');
    }
}