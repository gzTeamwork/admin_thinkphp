<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/7/25
 * Time: 下午7:10
 */

namespace app\inforward\model\post;

use app\inforward\middleware\base\mwModelBase;
use think\Model;

class PostTemplateModel extends Model
{
    use mwModelBase;
    // 设置当前模型对应的完整数据表名称
    protected $connection = 'db_admin_core';
    protected $table = 'posts_template';


}