<?php

namespace app\inforward\logic;

use app\inforward\model\UserMealSubmit;
use think\facade\Log;

class DailyMealLogic
{
    public $db = null;

    public function __construct()
    {
        $this->db = new UserMealSubmit();
    }
    //  增加用户报餐记录
    public function insert_user_meal($datas)
    {
        $mealSubmitModel = new UserMealSubmit();
        $mealSubmitModel->vaild_params($datas, ['user_id', 'meal_date', 'need_meal']);

        $datas['create_time'] = $datas['update_time'] = date('Y-m-d h:i:s', time());

        //  1.碰撞检查
        $where = [
            'user_id' => ['user_id', '=', $datas['user_id']],
            'meal_date' => ['meal_date', '=', $datas['meal_date']],
        ];
        $existSubmit = $mealSubmitModel->where($where)->select();
        // var_dump(count($existSubmit));
        //  2.不存在重复则增加 - 存在则更新
        if (count($existSubmit) == 0) {
            $mealSubmitModel = new UserMealSubmit();
            $datas['enable'] = 1;
            $res = $mealSubmitModel->allowField(true)->save($datas);
            Log::info('[数据库增加操作]' . $datas['update_time'] . ":成功新增用户提交的报餐记录,更新记录id为" . $res);
        } else {
            unset($datas['create_time']);
            $res = $mealSubmitModel->update($datas, $where);
            Log::info('[数据库更新操作]' . $datas['update_time'] . ":成功更新用户提交的报餐记录,更新记录id为" . $res);
        }
        return json($res);
    }
    //  查找用户报餐记录
    public function get_user_daily_meal($userid, $beginDate = null, $endDate = null)
    {
        $beginDate = is_null($beginDate) ? '-2 day' : $beginDate;
        $endDate = is_null($endDate) ? '+5 day' : $endDate;
        $where = [
            'user_id' => ['user_id', '=', $userid],
            'create_time' => ['create_time', 'between time', [$beginDate, $endDate]],
        ];
        $result = $this->db->where($where)->select();
        if (!empty($result)) {
            $result = $result->toArray();
            $result = array_combine(array_column($result, 'meal_date'), $result);
        }
        return $result;
    }
    //  汇总明天报餐的用户
    public function getTomorrowDailMeals($date = null)
    {
        $date = is_null($date) ? strtotime("+1 day") : $date;
        $where = ['meal_date' => ['meal_date', '=', date('Y-m-d', $date)]];

    }
}
