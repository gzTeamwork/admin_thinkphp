<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/28
 * Time: 下午5:46
 */

namespace app\admin\apiHandler;

use app\admin\model\configurationModel;
use think\Exception;

/**
 * Trait SystemApiHandler
 * @package app\admin\apiHandler
 * @deprecated 本接口已改为AdvancedApiHandler
 */
trait SystemApiHandler
{

    /**
     * 数据接口 - 获取系统配置
     * @todo 需要加上使用者权限验证
     * @todo 上缓存
     */
    public function api_system_configuration()
    {
        try {
//            $cacheAdmin = Cache::get('')get
//            $cacheSystemConfig = Cache::get('')
            $configModel = new configurationModel();
            $systemConfigs = $configModel->getSystemConfigs('all');
            $this->success('成功获取系统配置项', '', ['configs' => $systemConfigs]);
        } catch (Exception $exception) {
            $this->error('获取配置错误');
        }
    }
}