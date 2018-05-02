<?php

namespace app\inforward\logic;

use app\inforward\model\UserMealSubmit;
use think\Log;
use think\facade\Log;

class DailyMealLogic
{

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
        //  2.不存在重复则增加
        if (count($existSubmit) == 0) {
            $mealSubmitModel = new UserMealSubmit();
            $datas['enable'] = 1;
            $res = $mealSubmitModel->allowField(true)->save($datas);
            Log::info('[数据库增加操作]'.$datas['update_time'].":成功新增用户提交的报餐记录,更新记录id为".$res);
        } else {
            unset($datas['create_time']);
            $res = $mealSubmitModel->update($datas);
            Log::info('[数据库更新操作]' .$date['update_time']. ":成功更新用户提交的报餐记录,更新记录id为" . $res);
        }
        return $res;
    }
}
