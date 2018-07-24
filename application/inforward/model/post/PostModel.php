<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-24 0024
 * Time: 8:26
 */

namespace app\inforward\model\post;

use app\inforward\middleware\base\mwModelBase;
use think\Model;

class PostModel extends Model
{
    use mwModelBase;
    // 设置当前模型对应的完整数据表名称
    protected $connection = 'db_admin_core';
    protected $table = 'post';
    
    public function extra()
    {
        return $this->hasOne('PostExtraModel','pid');
    }

}