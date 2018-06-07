<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/6
 * Time: 上午11:23
 */

namespace app\inforward\logic;

use think\db\exception\DataNotFoundException;

trait BaseModel
{
    /**
     * 获取数据查询预处理结果
     * @param $result
     * @return null
     * @throws DataNotFoundException
     */
    public function getResult(&$result)
    {
        if (is_null($result)) {
            throw new DataNotFoundException();
            return nulll;
        } else {
            return $result->toArray();
        }
    }
}