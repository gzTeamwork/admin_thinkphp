<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/8/8
 * Time: 下午2:59
 */

namespace app\inforward\apiHandler;

use app\inforward\model\DynamicModel;
use think\Exception;

trait  DynamicApiHandler
{

    /**
     * 接收访客公益留言
     * @param $datas
     */
    public function api_accept_benefit_dynamics($datas)
    {
        try {
            if (isset($datas['id']))
                unset($datas['id']);
            $datas['group'] = 'benefit';
            $dynamicModel = new DynamicModel();
            $result = $dynamicModel->allowField(true)->save($datas);

            $successMsg = '成功获取评论';
            $this->success($successMsg, '', $result);

        } catch (Exception $exception) {
            $errorMsg = '';
            $this->error($errorMsg ?? $exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * @param $datas
     */
    public function api_get_dynamics($datas)
    {
        try {
            $dynamicModel = new DynamicModel();
            $whereData = $dynamicModel->fieldsFilterByDataTable($datas);
            $result = $dynamicModel->where($whereData)->order('create_time', 'asc')->limit(20)->select();

            $successMsg = '成功获取留言信息';
            $this->success($successMsg, '', $result);

        } catch (Exception $exception) {
            $errorMsg = '获取留言信息失败';
            $this->error($errorMsg ?? $exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * @param $datas
     */
    public function api_get_order_benefit_dynamic($datas)
    {
        $datas['group'] = 'benefit';
        return $this->api_get_dynamics($datas);
    }
}