<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/30
 * Time: 上午11:09
 */

namespace app\inforward\middleware\dashboard;

use app\inforward\middleware\base\mwModelBase;
use app\inforward\middleware\helper\mwHelper;
use app\inforward\model\dashboard\menuModel;
use think\Exception;

class mwDashboard
{
    use mwModelBase;

    /**
     * 获取管理后台菜单
     * @param array $where
     * @return array
     */
    public static function getMenus(array $where = [])
    {
        try {
            $menuModel = new menuModel();
            $where = $menuModel->fieldsNeed(['is_active' => 1, 'is_show' => 1], $where);
            $res = $menuModel->where($where)->select();
            $res = $menuModel->getResult($res, false);
            return $res;
        } catch (Exception $exception) {

        }
    }

    /**
     * 排序
     * @param array $where
     * @return array
     */
    public static function getMenusTree(array $where = [])
    {
        $menus = self::getMenus($where);
        $menus = mwHelper::hTree($menus);
        return $menus;
    }
}
