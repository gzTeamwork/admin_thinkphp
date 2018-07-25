<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/7/24
 * Time: 下午4:13
 */

namespace app\inforward\model\cate;

use app\inforward\middleware\base\mwModelBase;
use think\Model;

class CateModel extends Model
{
    use mwModelBase;
    // 设置当前模型对应的完整数据表名称
    protected $connection = 'db_admin_core';
    protected $table = 'categorys';

//    public function extra()
//    {
//        return $this->hasOne('PostExtraModel', 'pid');
//}
}