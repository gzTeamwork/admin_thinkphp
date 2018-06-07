<?php

namespace app\inforward\controller;

use think\Exception;
use think\exception\HttpException;

use think\Controller;
use app\inforward\logic\BaseController;
use app\inforward\logic\DailyMealLogic;
use app\inforward\logic\meal\mealMenuLogic;


header("Access-Control-Allow-Origin:*");

/**
 * 报餐Api接口类 - 20180606启用 by Zicok
 * 主要用于处理报餐数据功能
 * Class MealsApi
 * @package app\inforward\controller
 */
class MealsApi extends Controller
{
    use BaseController;
    use DailyMealLogic;
    use mealMenuLogic;

    /**
     * 获取最近报餐数据
     * 默认获取2日之内
     */
    public function get_recent_total()
    {
        $lateDays = $this->request->param('days', 2);
        try {
            $result = $this->get_late_day_meals($lateDays);
            return $this->_standard_response($result, 200);
        } catch (Exception $e) {
            return $this->_standard_response($e->getMessage(), 400);
        }
    }

    /**
     * 用户最近报餐
     * 获取用户最近7天的报餐数据
     */
    public function get_user_meals()
    {
        try {
            //  获取日期 - 默认从今日算起
            $beginDay = $this->request->param('beginDay', time());
            $userId = $this->request->param('user_id', function () {
                throw new HttpException(400, '缺少用户id');
            });
//            $result = $this->get_user_daily_meal();
        } catch (Exception $e) {
            return json(400, $e->getMessage());
        }
    }

    /**
     * 获取周期菜单
     * 获取2周内菜单数据
     */
    public function get_meal_menu()
    {
        try {
            //  获取时间段
            $beginDate = $this->request->param('begin_date', strtotime("-7 days"));
            $endDate = $this->request->param('end_date', strtotime("+7 days"));
            $result = $this->get_menu_recent($beginDate, $endDate);
            return $this->_standard_response($result, 200);
        } catch (Exception $e) {
            return $this->_standard_response($e->getMessage(), 400);
        }
    }


}
