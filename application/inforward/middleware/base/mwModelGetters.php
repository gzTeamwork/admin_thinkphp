<?php

/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/7/25
 * Time: 上午11:22
 */

namespace app\inforward\middleware\base;

/**
 * 数据库模型获取器
 * Trait mwModelGetters
 * @package app\inforward\middleware\base
 */
trait mwModelGetters
{
    protected function setIsActiveAttr($value)
    {
        return $value === true || $value === 1;
    }

    protected function setCreateTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    protected function setUpdateTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }
}