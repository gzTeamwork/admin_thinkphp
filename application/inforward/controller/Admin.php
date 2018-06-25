<?php

namespace app\inforward\controller;

use app\inforward\middleware\base\mwControllerBase;
use app\inforward\unit\userUnit;
use think\App;
use think\Controller;
use think\Exception;

class Admin extends Controller
{
    use mwControllerBase;
    use mwAp;

    public function __construct(App $app = null)
    {
        parent::__construct($app);
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


    public function api_admin_login()
    {
        try {
            $account = $this->getParam('account', null, true);
            $password = $this->getParam('password', null, true);
            if (is_null($account) || is_null($password)) {
                throw new Exception('缺少必要参数', 403);
            }
        } catch (Exception $exception) {
            $this->error($exception->getMessage(), $exception->getCode());
        }

    }

//
//    public function admin_login()
//    {
//        $account = $this->request->param('login_account');
//        $password = $this->request->param('login_password');
//
//        try {
//            if (is_null($account) || is_null($password)) {
//                throw new Exception('用户登录缺少帐号或密码', 304);
//            }
//        } catch (Exception $e) {
//            return json();
//        }
//    }

}
