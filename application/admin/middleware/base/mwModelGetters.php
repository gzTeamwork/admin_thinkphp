<?php

/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/7/25
 * Time: 上午11:22
 */

namespace app\admin\apiHandler\middleware\base;

/**
 * 数据库模型获取器
 * Trait mwModelGetters
 * @package app\admin\logic\base
 */
trait mwModelGetters
{
    //  数据是否可用
    protected function setIsActiveAttr($value)
    {
        return $value === true || $value === 1;
    }

    //  创建时间 - 如缺少则与update相同
    protected function setCreateTimeAttr($value, $datas)
    {
        $value = $value ?? time();
        return date('Y-m-d H:i:s', $value);
    }

    //  更新时间
    protected function setUpdateTimeAttr($value)
    {
        $value = $value ?? time();
        return date('Y-m-d H:i:s', $value);
    }
}
