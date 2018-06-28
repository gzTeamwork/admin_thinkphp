<?php

namespace app\inforward\controller;

use app\inforward\controller\apiHandler\AdminApiHandler;
use app\inforward\controller\apiHandler\SystemApiHandler;
use app\inforward\controller\apiHandler\UserApiHandler;
use app\inforward\middleware\base\mwApi;
use app\inforward\middleware\base\mwControllerBase;
use app\inforward\unit\userUnit;
use think\App;
use think\Controller;
use think\Exception;

class Admin extends Controller
{
    use mwControllerBase;
    use AdminApiHandler;
    use UserApiHandler;
    use SystemApiHandler;

    public function __construct(App $app = null)
    {
        parent::__construct($app);
    }

    public function api()
    {
        return mwApi::api($this);
    }

    /**
     * 默认首页
     */
    public function index()
    {
        return $this->dashboard();
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
