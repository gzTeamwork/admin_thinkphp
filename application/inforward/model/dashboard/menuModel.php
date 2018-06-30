<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/30
 * Time: 上午10:28
 */

namespace app\inforward\model\dashboard;

use app\inforward\middleware\base\mwModelBase;
use think\Exception;
use think\Model;

class menuModel extends Model
{
    use mwModelBase;
    // 设置当前模型对应的完整数据表名称
    protected $connection = 'db_admin_core';
    protected $table = 'dashboard_menu';


}