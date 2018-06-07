<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/7
 * Time: 下午3:36
 */

namespace app\inforward\logic\meal;

use think\Exception;
use  app\inforward\model\MealMenu as MealMenuModel;

trait mealMenuLogic
{

    /**
     * 获取最近菜单数据
     * 获取今天为准前后7天内的报餐菜单数据
     * @param null $beginDate
     * @param null $endDate
     * @return null
     */
    public function get_menu_recent($beginDate = null, $endDate = null)
    {
        //  默认开始时间为当天
        $beginDate = $beginDate || strtotime("-7 days");
        //  默认结束时间为7天后
        $endDate = $endDate || strtotime("+7 days");
        $menuModel = new MealMenuModel();
        try {
            $where = [
                'create_time' => ['create_time', 'between time', [$beginDate, $endDate]],
            ];
            $result = $menuModel->where($where)->select();
            return $menuModel->getResult($result);
        } catch (Exception $e) {

        }
    }
}