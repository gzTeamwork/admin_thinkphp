<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/8/8
 * Time: 下午4:04
 */

namespace app\inforward\model\user;

use app\inforward\middleware\base\mwModelBase;
use think\Model;

class userSessionModel extends Model
{

    use mwModelBase;
    // 设置当前模型对应的完整数据表名称
    protected $connection = 'db_user_center';
    protected $table = 'user_session';


}