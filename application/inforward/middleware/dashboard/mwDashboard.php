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
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    static public function getMenus(array $where = []): array
    {
        $menuModel = new menuModel();
        $where = $menuModel->needQueryFields(['isActive' => 1, 'isShow' => 1], $where);
        $res = $menuModel->where($where)->select();
        $res = $menuModel->getResult($res);
//        var_dump($res);
        return $res;
    }

    static public function getMenusTree(array $where = []): array
    {
        $menus = self::getMenus($where);
        $menus = mwHelper::hTree($menus);
//        var_dump($menus);
        return $menus;
    }
}
