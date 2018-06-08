<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/6
 * Time: 上午11:23
 */

namespace app\inforward\logic\base;

use think\db\exception\DataNotFoundException;

trait BaseModelLogic
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

    /**
     * 以列值为数组key返回结果
     * @param $result
     * @param $colName
     * @return array|null
     */
    public function getResultByCol($result, $colName)
    {
        if (is_null($result)) {
            return null;
        } else {
            return array_combine(array_column($result, $colName), $result);
        }
    }
}