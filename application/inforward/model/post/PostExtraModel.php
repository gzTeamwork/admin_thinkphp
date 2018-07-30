<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/7/25
 * Time: 下午5:13
 */

namespace app\inforward\model\post;

use app\inforward\middleware\base\mwModelBase;
use think\Model;

class PostExtraModel extends Model
{
    use mwModelBase;
    // 设置当前模型对应的完整数据表名称
    protected $connection = 'db_admin_core';
    protected $table = 'posts_extra';

    public function postExtraTable()
    {
        return $this->morphTo();
    }

}