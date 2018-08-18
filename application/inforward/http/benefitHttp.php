<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/8/18
 * Time: 下午1:08
 */

namespace inforward\http;

use think\worker\Server;

class benefitHttp extends Server
{
    protected $socket = 'http://0.0.0.0:2346';

    public function onMessage($connection, $data)
    {
        $connection->send(json_encode($data));
    }
}