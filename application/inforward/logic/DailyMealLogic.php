<?php

namespace app\inforward\logic;

use app\inforward\model\UserMealSubmit;
use think\Exception;
use think\facade\Log;

trait DailyMealLogic
{
    /**
     * insert_user_meal
     * 增加用户报餐
     * @param $data
     * @return \think\response\Json
     */
    public function insert_user_meal($data)
    {
        $db = new UserMealSubmit();
//        $mealSubmitModel->valid_params($data, ['user_id', 'meal_date', 'need_meal']);

        $data['create_time'] = $data['update_time'] = date('Y-m-d h:i:s', time());

        //  1.碰撞检查
        $where = [
            'user_id' => ['user_id', '=', $data['user_id']],
            'meal_date' => ['meal_date', '=', $data['meal_date']],
        ];
        //  是否存在相同的提交记录
        $existSubmit = $db->where($where)->find();
        //  2.不存在重复则增加 - 存在则更新
        if (is_null($existSubmit)) {
            $db = new UserMealSubmit();
            $data['enable'] = 1;
            $res = $db->allowField(true)->save($data);
            Log::info('[数据库增加操作]' . $data['update_time'] . ":成功新增用户提交的报餐记录,更新记录id为" . $res);
        } else {
            unset($data['create_time']);
            $res = $db->update($data, $where);
            Log::info('[数据库更新操作]' . $data['update_time'] . ":成功更新用户提交的报餐记录,更新记录id为" . $res);
        }
        return json($res);
    }

    /**
     * get_user_daily_meal
     * 获取用户报餐数据
     * @param $userid
     * @param null $beginDate
     * @param null $endDate
     * @return array
     */
    public function get_user_daily_meal($userid, $beginDate = null, $endDate = null)
    {
        $db = new UserMealSubmit();

        $beginDate = is_null($beginDate) ? time() : $beginDate;
        $endDate = is_null($endDate) ? '+7 day' : $endDate;
        $where = [
            'user_id' => ['user_id', '=', $userid],
            'create_time' => ['create_time', 'between time', [$beginDate, $endDate]],
        ];
        $result = $db->where($where)->select();
        if (!is_null($result)) {
            $result = $result->toArray();
            $result = array_combine(array_column($result, 'meal_date'), $result);
        }
        return $result;
    }

    /**
     * 获取最近报餐数据
     * 默认获取2日之内
     * @return MealsApi
     */
    public function get_late_day_meals($lateDays = 2)
    {
        $db = new UserMealSubmit();
        //  今天日期
        $today = date('Y-m-d', time());
        //  明天日期
        $tomorrow = date('Y-m-d', strtotime("+1 day"));
        $result = $db->alias('a')->join('users b', 'a.user_id = b.userid')->where('meal_date', ['eq', $today], ['eq', $tomorrow], 'or')->order('meal_date', 'asc')->select();
        $result = is_null($result) ? null : $result->toArray();
        if (!is_null($result)) {
            $resData = [];
            foreach ($result as $i) {
                $resData[$i['meal_date']][] = $i;
            }
        } else {
            $resData = null;
        }
        return $resData;
    }


    /**
     * @deprecated 本函数已经弃用
     * @param null $date
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getTomorrowDailMeals($date = null)
    {
        $date = is_null($date) ? strtotime("+1 day") : $date;
        $where = ['meal_date' => ['meal_date', '=', date('Y-m-d', $date)]];
        // $this->db;
        $db = new UserMealSubmit();
        $result = $db->alias('a')->join('users b', 'a.user_id = b.userid')->where($where)->select();
        // var_dump($this->db->getLastSql());
        if (!empty($result)) {
            $result = $result->toArray();
        }
        return $result;
    }
}
