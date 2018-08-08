<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/8/6
 * Time: 上午9:44
 */

namespace app\inforward\apiHandler;

use app\inforward\model\order\OrderModel;
use think\Exception;

trait OrderApiHandler
{
    /**
     * 接收预约信息
     * @param $datas
     */
    public function api_accept_unit_order($datas)
    {
        try {

            $saveData['order_type'] = $datas['bookmode'];
            $saveData['order_date'] = date("Y-m-d H:i:s", time());
            $saveData['order_name'] = $datas['name'];
            $saveData['order_tel'] = $datas['tel'];
            $saveData['order_company'] = $datas['companyname'];
            $saveData['order_content'] = json_encode($datas);
            $saveData['order_id'] = isset($datas['pid']) ? $datas['pid'] : false;
            $saveData['order_kind'] = isset($datas['kind']) ? $datas['kind'] : 'unit_booking';

            $result = (new OrderModel())->allowField(true)->save($saveData);

            $this->success('预约成功', '', $result);

        } catch (Exception $exception) {
            $this->error('预约请求失败', '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * 获取盘源预约
     * @param $datas
     */
    public function api_get_orders($datas)
    {
        try {

            $orderModel = new OrderModel();
            $whereDatas = $orderModel->fieldsFilterByDataTable($datas);

            $result = $orderModel->where($whereDatas)->select();

            $successMsg = '成功获取预约信息';
            $this->success($successMsg, '', $result);
        } catch (Exception $exception) {
            $errorMsg = '获取预约信息失败';
            $this->error($errorMsg ?? $exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * 获取单元预约信息
     * @param $datas
     */
    public function api_get_order_booking($datas)
    {
        $datas['kind'] = 'unit_booking';

        try {

            $orderModel = new OrderModel();
            $whereDatas = $orderModel->fieldsFilterByDataTable($datas);

            $result = $orderModel->where($whereDatas)->order('order_date','desc')->select();

            $successMsg = '成功获取盘源预约订单';
            $this->success($successMsg, '', $result);
        } catch (Exception $exception) {
            $errorMsg = '获取盘源预约订单失败';
            $this->error($errorMsg ?? $exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }

    }
}