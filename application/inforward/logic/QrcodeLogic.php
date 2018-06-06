<?php

namespace app\inforward\logic;

use \app\inforward\model\ItemsQrcode;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;

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
        try {
            $item = $db->where('unionid', $unionId)->find();
        } catch (DataNotFoundException $e) {
        } catch (ModelNotFoundException $e) {
        } catch (DbException $e) {
        }
        return $item;
    }

    public function getItems($num = 20)
    {
        $db = new \app\inforward\model\ItemsQrcode();
        try {
            $result = $db->limit($num)->select();
        } catch (DataNotFoundException $e) {
        } catch (ModelNotFoundException $e) {
        } catch (DbException $e) {
        }
        return is_null($result) ? $result : $result->toArray();
    }

    public function insertItems($items)
    {
        $db = new \app\inforward\model\ItemsQrcode();
        try {
            $result = $db->saveAll($items);
        } catch (\Exception $e) {
        }
        return $result;
    }
}
