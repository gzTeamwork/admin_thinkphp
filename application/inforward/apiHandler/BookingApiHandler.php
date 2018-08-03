<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/8/3
 * Time: 下午7:22
 */

namespace app\inforward\apiHandler;

use app\admin\apiHandler\PostApiHandler as AdminPostAPi;
use think\Exception;

trait BookingApiHandler
{
    use AdminPostAPi;

    /**
     * 接收预约信息
     * @param $datas
     */
    public function api_accept_unit_booking($datas)
    {
        try {
            $this->success('接收数据成功', '', $datas);
        } catch (Exception $exception) {
            $this->error('接收数据失败', '', ['msg' => $exception->getMessage()]);
        }
    }

}