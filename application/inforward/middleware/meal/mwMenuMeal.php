<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/19
 * Time: 上午9:21
 */

namespace app\inforward\middleware;

use app\inforward\middleware\base\mwModelBase;
use app\inforward\model\MealMenu as MealMenuModel;
use think\Exception;
use think\facade\Log;

trait mwMenuMeal
{
    use mwModelBase;

    /**
     * @param null $beginDate
     * @param null $endDate
     * @return mixed
     */
    public function getMenuRecent($beginDate = null, $endDate = null)
    {
        //  开始时间
        $beginDate = $beginDate || strtotime(" -7 days");
        //  结束时间
        $endDate = $endDate || strtotime("+7 days");

        $menuModel = new MealMenuModel();

        try {
            $where = [
                'create_time' => ['create_time', 'between time', [$beginDate, $endDate]],
            ];
            $result = $menuModel->where($where)->select();
            return $menuModel->getResult($result);
        } catch (Exception $exception) {
            Log::error(__METHOD__ . '查找最近报餐菜单结果为空');
        }
    }
}