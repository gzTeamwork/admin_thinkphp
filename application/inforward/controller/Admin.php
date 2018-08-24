<?php

namespace app\inforward\controller;

use app\admin\apiHandler\AdminApiHandler;
use app\admin\apiHandler\AdvancedApiHandler;
use app\admin\apiHandler\CateApiHandler;
use app\admin\apiHandler\SystemApiHandler;
use app\admin\apiHandler\UserApiHandler;
use app\admin\apiHandler\UploadApiHandler;

use app\inforward\apiHandler\DynamicApiHandler;
use app\inforward\apiHandler\OrderApiHandler;
use app\inforward\apiHandler\TokenApiHandler;
use app\inforward\middleware\base\mwApi;
use app\inforward\middleware\base\mwControllerBase;
use app\inforward\unit\userUnit;
use app\inforward\apiHandler\PostApiHandler;

use think\App;
use think\Controller;

/**
 * Class Admin
 * @package app\inforward\controller
 * @todo 本类大部分功能已弃用,由于采用数据分离开发模式后,本类功能已经抽离到admin/adminApiHandler中,仅存api方法用于调用对应的apiHandler方法
 */
class Admin extends Controller
{
    use mwControllerBase;

    //  载入系统Api
    use AdminApiHandler, UserApiHandler, SystemApiHandler, CateApiHandler, PostApiHandler, UploadApiHandler, AdvancedApiHandler;

    //  载入inforward Api
    use OrderApiHandler, DynamicApiHandler, TokenApiHandler;

    public function __construct(App $app = null)
    {
        parent::__construct($app);
    }

    /**
     * Api调用方法
     * @return \think\response\Json
     */
    public function api()
    {
        $datas = $this->request->param(true);
        return mwApi::api($this, $datas);
    }

    /**
     * 默认首页
     */
    public function index()
    {
//        return $this->dashboard();
        return "welcome to inforward admin api dashboard ";
    }

    /**
     * 管理后台面板
     */
    public function dashboard()
    {
        $user = new userUnit();
        $this->view->engine->layout('admin/layout');
//        $user->isAdmin() ? '' : $this->redirect('inforward/admin/login');

        return $this->fetch('admin/index');
    }

    /**
     * 管理员登录入口
     * @return mixed
     */
    public function login()
    {
        return $this->fetch('admin/login');
    }


}
