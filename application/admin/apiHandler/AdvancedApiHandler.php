<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/8/8
 * Time: 上午9:51
 */

namespace app\admin\apiHandler;

use app\admin\model\AdvancedModel;
use think\Exception;

trait AdvancedApiHandler
{
    /**
     * @param $datas
     */
    public function api_get_advanceds($datas)
    {
        try {
            $advModel = (new AdvancedModel());
            $whereDatas = AdvancedModel::fieldsFilter($advModel->getTableFields(), $datas);
            $result = $advModel->where($whereDatas)->select();
            $successMsg = '成功获取配置信息';
            $this->success($successMsg, '', $result);
        } catch (Exception $exception) {
            $errorMsg = '获取配置信息失败';
            $this->error($errorMsg ?? $exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * @param $datas
     * @throws \Exception
     */
    public function api_set_advanceds($datas)
    {
        try {
            $newDatas = $upDatas = [];
            foreach ($datas as $key => $item) {
                $item['group'] = 'website';
                isset($item['id']) ? array_push($upDatas, $item) : array_push($newDatas, $item);
            }
            is_null($newDatas) ?: (new AdvancedModel())->allowField(true)->saveAll($newDatas);
            is_null($upDatas) ?: (new AdvancedModel())->allowField(true)->saveAll($upDatas);
            $successMsg = '保存配置参数成功';
            $this->success($successMsg, '');
        } catch (Exception $exception) {
            $errorMsg = '保存失败';
            $this->error($errorMsg ?? $exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }
}