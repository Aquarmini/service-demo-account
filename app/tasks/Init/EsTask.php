<?php

namespace App\Tasks\Init;

use App\Tasks\Task;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Namespaces\IndicesNamespace;
use Xin\Cli\Color;
use Xin\Phalcon\Cli\Traits\Input;

class EsTask extends Task
{
    use Input;

    public function mainAction()
    {
        echo Color::head('Help:') . PHP_EOL;
        echo Color::colorize('  初始化Elasticsearch') . PHP_EOL . PHP_EOL;

        echo Color::head('Usage:') . PHP_EOL;
        echo Color::colorize('  php run init:es@[action]', Color::FG_LIGHT_GREEN) . PHP_EOL . PHP_EOL;

        echo Color::head('Actions:') . PHP_EOL;
        echo Color::colorize('  index        初始化索引', Color::FG_LIGHT_GREEN) . PHP_EOL;
        echo Color::colorize('  footmark     初始化我的足迹', Color::FG_LIGHT_GREEN) . PHP_EOL;
    }

    public function indexAction()
    {
        $config = di('app')->es;
        $client = ClientBuilder::create()
            ->setHosts($config->host->toArray())
            ->build();

        $indices = $client->indices();
        $index = $config->footmark->index;
        try {
            $params = [
                'index' => $index,
            ];
            $res = $indices->create($params);
            if ($res['acknowledged']) {
                echo Color::success("Index:{$index} 创建成功") . PHP_EOL;
            }
        } catch (\Exception $ex) {
            $res = json_decode($ex->getMessage(), true);
            echo Color::colorize($res['error']['reason'], Color::FG_LIGHT_RED) . PHP_EOL;
        }
    }

    public function footmarkAction()
    {
        $config = di('app')->es;
        $client = ClientBuilder::create()
            ->setHosts($config->host->toArray())
            ->build();

        $indices = $client->indices();
        $index = $config->footmark->index;
        $type = $config->footmark->type;
        $properties = $config->footmark->properties;

        try {
            if ($this->option('init')) {
                $this->footmarkSetMapping($indices, $index, $type, $properties);
            } else {
                $this->footmarkGetMapping($indices, $index, $type);
            }
        } catch (\Exception $ex) {
            $res = json_decode($ex->getMessage(), true);
            if ($res) {
                echo Color::colorize($res['error']['reason'], Color::FG_LIGHT_RED) . PHP_EOL;
            } else {
                echo Color::colorize($ex->getMessage(), Color::FG_LIGHT_RED) . PHP_EOL;
            }
        }
    }

    private function footmarkSetMapping(IndicesNamespace $indices, $index, $type, $properties)
    {
        $params = [
            'index' => $index,
            'type' => $type,
            'body' => [
                'properties' => $properties->toArray(),
            ],
        ];
        $res = $indices->putMapping($params);
        if ($res['acknowledged']) {
            echo Color::success('初始化我的足迹 成功') . PHP_EOL;
        }
    }

    private function footmarkGetMapping(IndicesNamespace $indices, $index, $type)
    {
        $params = [
            'index' => $index,
            'type' => $type,
        ];
        $res = $indices->getMapping($params);
        $print = json_encode($res, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo Color::colorize($print, Color::FG_GREEN) . PHP_EOL;
    }

}

