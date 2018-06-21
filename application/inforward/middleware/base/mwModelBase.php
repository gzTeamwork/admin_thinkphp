<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/19
 * Time: 上午9:01
 */

namespace app\inforward\middleware\base;

use think\db\exception\DataNotFoundException;

trait mwModelBase
{
    /**
     * 预处理获取数据结果
     * @param $result
     * @return null
     * @throws DataNotFoundException
     */
    public function getResult(&$result)
    {
        if (is_null($result)) {
            throw new DataNotFoundException();
            return null;
        } else {
            return is_array($result) ? $result : $result->toArray();
        }
    }

    /**
     * 以列值为数组key返回结果
     * @param $result
     * @param $colName
     * @return array
     */
    public function getResultByCol(&$result, $colName)
    {
        return array_combine(array_column($result, $colName), $result);
    }

}