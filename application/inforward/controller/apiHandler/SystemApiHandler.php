<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/28
 * Time: 下午5:46
 */

namespace app\inforward\controller\apiHandler;

use app\inforward\model\admin\configurationModel;
use think\Exception;

trait SystemApiHandler
{

    /**
     * 数据接口 - 获取系统配置
     * @todo 需要加上使用者权限验证
     */
    public function api_system_configuration()
    {
        try {
            $configModel = new configurationModel();
            $systemConfigs = $configModel->getSystemConfigs('all');
            $this->success('成功获取系统配置项', '', ['configs' => $systemConfigs]);
        } catch (Exception $exception) {
            $this->error('获取配置错误');
        }
    }
}