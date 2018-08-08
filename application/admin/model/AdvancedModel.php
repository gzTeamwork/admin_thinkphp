<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/8/8
 * Time: 上午9:46
 */

namespace app\admin\model;

use app\inforward\middleware\base\mwModelBase;
use think\Model;

class AdvancedModel extends Model
{
    use mwModelBase;
    // 设置当前模型对应的完整数据表名称
    protected $connection = 'db_admin_core';
    protected $table = 'advanceds';


    public function setValueAttr($value)
    {
        if (is_array($value))
            return json_encode($value);

        return $value;
    }

    /**
     * @param $value
     * @param $data
     * @return bool|mixed
     */
    public function getValueAttr($value, $data)
    {
        switch ($data['mode']) {
            case 'array':
                return json_decode($value);
                break;
            case 'boolean':
                return $value == 1;
                break;
            default:
                return $value;
        }
    }

}