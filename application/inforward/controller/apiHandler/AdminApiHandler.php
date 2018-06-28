<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/27
 * Time: 下午1:38
 */

namespace app\inforward\controller\apiHandler;

use think\facade\Cache;

trait AdminApiHandler
{
    /**
     * 获取后台菜单
     * @todo 应该根据用户权限进行过滤
     */
    public function api_admin_menu()
    {
        $menu = $this->_adminMenuInit();
        $this->success('成功获取后台菜单数据', '', $menu);
    }

    /**
     * 后台菜单初始化
     * @todo 追加不同用户的菜单缓存
     */
    protected function _adminMenuInit()
    {
        $adminMenu = Cache::get('admin_menu', null);
        if (is_null($adminMenu)) {
            $adminMenu = [
                'config' => [
                    'adminConfig' => [
                        'path' => '/admin/configuration',
                        'icon' => '',
                        'label' => '后台配置',
                        'name' => 'adminConfig',
                    ],
                    'test' => [
                        'path' => '/admin/test',
                        'icon' => '',
                        'label' => '测试链接',
                        'name' => 'testPage'
                    ]
                ]
            ];
            Cache::set('admin_menu', $adminMenu, 7200);
        }
        return $adminMenu;
    }
}