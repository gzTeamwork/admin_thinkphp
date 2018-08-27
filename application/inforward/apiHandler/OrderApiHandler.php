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
     * @todo 需要加上提交时间间隔限制与重复限制
     * showdoc
     * @catalog 前端接口/订单
     * @title 提交单元预约订单
     * @description 用于接收访客提交预约看盘订单
     * @method post
     * @url [hostname]/inforward/admin/api/do/api_accept_unit_order
     * @param token 必选 string 用户令牌
     * @param order_id 必选 int 预约对应文章的id
     * @param order_tel 必选 string 预约电话
     * @param order_name 必选 string 预约人姓名
     * @param order_company 可选 string 预约公司
     * @return {"code":1,"msg":"预约成功","data":true,"url":"","wait":3}
     * @number 99
     */
    public function api_accept_unit_order($datas)
    {
        try {
            $saveData['user_token'] = $datas['token'];
            $saveData['order_type'] = $datas['bookmode'] ?? 'visitor';
            $saveData['order_date'] = date("Y-m-d H:i:s", time());
            $saveData['order_name'] = $datas['name'];
            $saveData['order_tel'] = $datas['tel'];
            $saveData['order_company'] = $datas['companyname'] ?? false;
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
     * showdoc
     * @catalog 后端接口/订单
     * @title 获取多个订单
     * @description 获取用户订单接口
     * @method get
     * @url [hostname]/inforward/admin/api/do/api_get_orders
     * @param name 可选 string 提交预约的用户昵称
     * @param order_id 必选 int 预约对应文章的id
     * @param order_tel 必选 string 预约电话
     * @param order_name 必选 string 预约人姓名
     * @param order_company 可选 string 预约公司
     * @return {"code":1,"msg":"成功获取预约信息","data":[{"id":1,"order_type":"个人预约","order_date":"2018-08-08 14:32:21","order_name":"测试用户","order_tel":"13828412345","order_company":"inforward","order_content":"哦哦哦","order_id":28,"create_time":"2018-08-08 14:32:49","user_token":null,"order_kind":"office"},{"id":2,"order_type":"公司预约","order_date":"2018-08-08 14:37:20","order_name":"测试用户2","order_tel":"13828477777","order_company":"inforward.group","order_content":"哦哦哦JOJO","order_id":30,"create_time":"2018-08-08 14:37:44","user_token":null,"order_kind":"apartment"},{"id":3,"order_type":"visit","order_date":"2018-08-08 15:46:24","order_name":"b b","order_tel":"12","order_company":"cc","order_content":"{\"id\":59,\"bookmode\":\"visit\",\"name\":\"b b\",\"tel\":\"12\",\"companyname\":\"cc\"}","order_id":0,"create_time":"2018-08-08 15:46:24","user_token":null,"order_kind":"unit_booking"},{"id":4,"order_type":"teamwork","order_date":"2018-08-08 16:10:31","order_name":"nn","order_tel":"tf","order_company":"cc","order_content":"{\"id\":58,\"bookmode\":\"teamwork\",\"name\":\"nn\",\"tel\":\"tf\",\"companyname\":\"cc\"}","order_id":0,"create_time":"2018-08-08 16:10:31","user_token":null,"order_kind":"unit_booking"},{"id":5,"order_type":"visit","order_date":"2018-08-08 21:37:49","order_name":"23","order_tel":"123","order_company":"123","order_content":"{\"bookmode\":\"visit\",\"name\":\"23\",\"tel\":\"123\",\"companyname\":\"123\"}","order_id":0,"create_time":"2018-08-08 21:37:49","user_token":null,"order_kind":"unit_booking"},{"id":6,"order_type":"visit","order_date":"2018-08-08 21:54:13","order_name":"","order_tel":"","order_company":"","order_content":"{\"id\":27,\"bookmode\":\"visit\",\"name\":\"\",\"tel\":\"\",\"companyname\":\"\"}","order_id":0,"create_time":"2018-08-08 21:54:13","user_token":null,"order_kind":"unit_booking"},{"id":7,"order_type":"visit","order_date":"2018-08-09 09:26:05","order_name":"123","order_tel":"213","order_company":"4","order_content":"{\"id\":27,\"bookmode\":\"visit\",\"name\":\"123\",\"tel\":\"213\",\"companyname\":\"4\"}","order_id":0,"create_time":"2018-08-09 09:26:05","user_token":null,"order_kind":"unit_booking"},{"id":8,"order_type":"visitor","order_date":"2018-08-27 14:26:27","order_name":"1","order_tel":"1239","order_company":"","order_content":"{\"name\":\"1\",\"tel\":\"1239\"}","order_id":0,"create_time":"2018-08-27 14:26:27","user_token":null,"order_kind":"unit_booking"}],"url":"","wait":3}
     * @number 99
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
     * showdoc
     * @catalog 后端接口/订单
     * @title 获取单元订单
     * @description 获取用户单元订单接口
     * @method get
     * @url [hostname]/inforward/admin/api/do/api_get_order_booking
     * @param name 可选 string 提交预约的用户昵称
     * @param order_id 必选 int 预约对应文章的id
     * @param order_tel 必选 string 预约电话
     * @param order_name 必选 string 预约人姓名
     * @param order_company 可选 string 预约公司
     * @return
     * @return_param groupid int 用户组id
     * @return_param name string 用户昵称
     * @remark 这里是备注信息
     * @number 99
     */
    public function api_get_order_booking($datas)
    {
        $datas['kind'] = 'unit_booking';

        try {

            $orderModel = new OrderModel();
            $whereDatas = $orderModel->fieldsFilterByDataTable($datas);

            $result = $orderModel->where($whereDatas)->order('order_date', 'desc')->select();

            $successMsg = '成功获取盘源预约订单';
            $this->success($successMsg, '', $result);
        } catch (Exception $exception) {
            $errorMsg = '获取盘源预约订单失败';
            $this->error($errorMsg ?? $exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }

    }
}