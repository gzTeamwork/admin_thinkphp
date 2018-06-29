<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/19
 * Time: 上午9:01
 */

namespace app\inforward\middleware\base;

use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;

trait mwModelBase
{
    /**
     * 过滤查询字段
     * @param $fields
     * @param $query
     */
    public function filterFields($fields, $query)
    {
        return array_intersect_key($query, array_flip($fields));
    }

    /**
     * 预处理获取数据结果
     * @param $result
     * @return null
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     */
    public function getResult(&$result)
    {

        if (empty($result->toArray())) {
            throw new ModelNotFoundException('查找结果为空');
        }
        return $result->toArray();

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