<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/6
 * Time: 上午11:23
 */

namespace app\inforward\logic;

trait BaseModel
{
    public function getResult(&$result)
    {
        return is_null($result) ? null : $result->toArray();
    }
}