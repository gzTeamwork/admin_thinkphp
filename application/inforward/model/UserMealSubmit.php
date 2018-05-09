<?php

namespace app\inforward\model;

use think\Exception;
use think\exception\HttpException;
use think\Model;

class UserMealSubmit extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'user_meal_submit';

    //  专门用于检查传入参数
    public function vaild_params($datas, $needKeys)
    {
        try {
            if (is_array($needKeys)) {
                foreach ($needKeys as $key => $need) {
                    if (isset($datas[$need]) === false) {
                        throw new HttpException('501', '缺少输入的参数' . $need);
                    }
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $this;
    }
}
