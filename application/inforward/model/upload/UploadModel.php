<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/8/6
 * Time: 下午12:38
 */

namespace app\inforward\model\upload;

use app\inforward\middleware\base\mwModelBase;
use think\Model;

class UploadModel extends Model
{
    use mwModelBase;
    // 设置当前模型对应的完整数据表名称
    protected $connection = 'db_admin_core';
    protected $table = 'uploads';
}