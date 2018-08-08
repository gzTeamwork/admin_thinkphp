<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/28
 * Time: 下午4:43
 */

namespace app\inforward\model\admin;

use app\inforward\middleware\base\mwModelBase;
use think\Model;

class configurationModel extends Model
{

    use mwModelBase;
    // 设置当前模型对应的完整数据表名称
    protected $connection = 'db_admin_core';
    protected $table = 'configuration';

    /**
     * 获取系统配置项 - 通过群组
     * @param $group
     */
    public function getSystemConfigs($group = 'all')
    {
        $result = $this->select();
        return $this->getResult($result);
    }

}