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
        try {
            $lateDays = $this->request->param('days', 2);
            $result = $this->select_late_day_meals($lateDays);

            //  数据不足时需要填补空白数据
            if (count($result) < $lateDays) {
                for ($i = 0; $i < $lateDays; $i++) {
                    $result[date("Y-m-d", strtotime('+' . ($i + 1) . ' day'))] = [];
                }
            }
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
            $beginDate = $this->request->param('beginDay', strtotime('-7 days'));
            $endDate = strtotime('+7 days');
            $userId = $this->request->param('user_id', null);
            if (is_null($userId)) {
                throw new HttpException(400, '缺少用户id');
            }
            $result = $this->select_user_daily_meal($userId, $beginDate, $endDate);
            return $this->_standard_response($result, 200);
        } catch (Exception $e) {
            return $this->_standard_response($e->getMessage(), 400);
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
            $beginDate = $this->request->param('begin_date', strtotime('-7 days'));
            $endDate = $this->request->param('end_date', strtotime("+7 days"));
            $result = $this->get_menu_recent($beginDate, $endDate);
            $this->getResultByCol($result, 'meal_date');
            return $this->_standard_response($result, 200);
        } catch (Exception $e) {
            return $this->_standard_response($e->getMessage(), 400);
        }
    }

    /**
     * 处理用户报餐提交
     * @return \think\response\Json
     */
    public function attend_user_meal()
    {
        $userId = $this->request->param('user_id', null);
        $dailyMealDate = $this->request->param('meal_date', null);
        $dailyMealCheck = $this->request->param('meal_check', false);
        $dailyMealCheck = $dailyMealCheck ? 1 : 0;
        try {
            if (is_null($userId) && is_null($dailyMealDate)) {
                throw new HttpException(400, '参数不允许为空');
            } else {
                $result = $this->insert_user_meal(
                    ['user_id' => $userId, 'meal_date' => $dailyMealDate, 'need_meal' => $dailyMealCheck]
                );
//                var_dump($result);
                return $this->_standard_response($result, 200);
            }
        } catch (Exception $e) {
            return $this->_standard_response($e->getMessage(), 400);
        }
    }


}
