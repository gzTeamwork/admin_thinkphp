<?php
namespace app\inforward\model;

use think\Model;

class UserSubmitModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'user_submits';

    public function getCreateTimeAttr($value)
    {
        return intval($value);
    }
}
