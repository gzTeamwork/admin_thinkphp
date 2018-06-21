<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/19
 * Time: 上午10:41
 */

namespace app\inforward\middleware\qrcode;

use think\Exception;
use app\inforward\model\ItemsQrcode;

trait mwQrcode
{
    /**
     * 获取单个二维码
     * @param $unionId
     * @return array|null|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     */
    public function getItem($unionId)
    {
        try {
            $db = new ItemsQrcode();
            $result = $db->where('unionid', $unionId)->find();
        } catch (Exception $e) {
        }
        return $db->getResult($result);
    }

    /**
     * 获取多个二维码
     * @param int $num
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     */
    public function getItems($num = 20)
    {
        $db = new ItemsQrcode();
        try {
            $result = $db->limit($num)->select();
        } catch (Exception $e) {
        }
        return $db->getResult($result);
    }

    /**
     * 增加二维码
     * @param $items
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \Exception
     */
    public function insertItems($items)
    {
        $db = new ItemsQrcode();
        try {
            $result = $db->saveAll($items);
        } catch (Exception $e) {
        }
        return $db->getResult($result);
    }
}