<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/8/8
 * Time: 下午2:57
 */

namespace app\inforward\model;

use app\inforward\middleware\base\mwModelBase;
use think\Model;

class DynamicModel extends Model
{
    use mwModelBase;
    // 设置当前模型对应的完整数据表名称
    protected $connection = 'db_user_center';
    protected $table = 'dynamics';

}