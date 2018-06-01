<?php

namespace app\inforward\logic;

use \app\inforward\model\ItemsQrcode;

/**
 * Trait QrcodeLogic
 * @package app\inforward\logic
 * 二维码逻辑层
 */
trait QrcodeLogic
{
    public static function getItem($unionId)
    {
        $db = new ItemsQrcode();
        $item = $db->where('unionid', $unionId)->find();
        return $item;
    }

    public function getItems($num = 20)
    {
        $db = new \app\inforward\model\ItemsQrcode();
        $result = $db->limit($num)->select();
        return is_null($result) ? $result : $result->toArray();
    }

    public function insertItems($items)
    {
        $db = new \app\inforward\model\ItemsQrcode();
        $result = $db->saveAll($items);
        return $result;
    }
}
