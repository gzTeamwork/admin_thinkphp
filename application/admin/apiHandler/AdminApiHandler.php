<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/27
 * Time: 下午1:38
 */

namespace app\admin\apiHandler;

use app\inforward\middleware\dashboard\mwDashboard;
use think\Exception;
use think\facade\Cache;

trait AdminApiHandler
{
    /**
     * 获取后台菜单
     * @todo 应该根据用户权限进行过滤
     */
    public function api_admin_menu()
    {
        try {
            $where = ['group' => ['post', 'category', 'configuration', 'total', 'user']];
            $menus = self::_getAdminMenu($where);
            $this->success('成功获取后台菜单数据', '', $menus);
        } catch (Exception $exception) {
            $this->error('获取后台菜单数据失败', '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * 后台菜单初始化
     * @todo 追加不同用户的菜单缓存
     * @param array $where
     * @param bool $isCache
     * @return array
     */
    protected function _getAdminMenu(array $where = [], $isCache = false)
    {
        $adminMenu = ($isCache && Cache::has('admin_menu')) ? Cache::get('admin_menu') : mwDashboard::getMenusTree($where);
        $isCache ? Cache::set('admin_menu', $adminMenu, 7200) : null;
        return $adminMenu;
    }

    /**
     * 获取管理员用户菜单
     */
    public function api_admin_profile_menu()
    {
        try {
            $menus = $this->_getAdminMenu(['group' => ['userProfile']]);
            $this->success('成功获取管理员用户菜单', '', $menus);
        } catch (Exception $exception) {
            $this->error('获取管理员菜单失败', '', ['msg' => $exception->getMessage()]);
        }
    }

}
