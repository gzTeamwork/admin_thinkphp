<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/7/2
 * Time: 下午1:47
 */

namespace app\inforward\model\user;

use app\inforward\middleware\base\mwModelBase;
use think\Model;

class roleModel extends Model
{
    use mwModelBase;
    // 设置当前模型对应的完整数据表名称
    protected $connection = 'db_user_center';
    protected $table = 'role_list';


}