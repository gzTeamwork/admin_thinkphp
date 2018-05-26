<?php

namespace app\inforward\logic;

use \app\inforward\model\QrcodeItems;

class QrcodeLogic
{
    public function getItem($unionid)
    {
        $db = new QrcodeItems();
        $item = $db->where('unionid', $unionid)->find();
        return $item;
    }

    public function getItems($num = 20)
    {
        $db = new \app\inforward\model\QrcodeItems();
        $result = $db->limit($num)->select();
        return is_null($result) ? $result : $result->toArray();
    }

    public function insertItems($items)
    {
        $db = new \app\inforward\model\QrcodeItems();
        $result = $db->saveAll($items);
        return $result;
    }
}
