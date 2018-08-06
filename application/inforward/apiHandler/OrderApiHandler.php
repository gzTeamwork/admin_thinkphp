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

            $result = (new OrderModel())->allowField(true)->save($saveData);

            $this->success('预约成功', '', $result);
        } catch (Exception $exception) {
            $this->error('预约请求失败', '', ['msg' => $exception->getMessage()]);
        }
    }
}