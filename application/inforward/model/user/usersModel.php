<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/28
 * Time: 上午10:03
 */

namespace app\inforward\model\user;


use app\inforward\middleware\base\mwModelBase;
use think\facade\Config;
use think\Model;

class usersModel extends Model
{
    use mwModelBase;
    // 设置当前模型对应的完整数据表名称
    protected $connection = 'db_user_center';
    protected $table = 'user_list';


}