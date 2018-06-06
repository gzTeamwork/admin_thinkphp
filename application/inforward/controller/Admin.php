<?php

namespace app\inforward\controller;

use think\Controller;
use think\Request;

class Admin extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function dashboard()
    {
        //  后台首页
    }

    //  后台管理员登陆
    public function admin_login()
    {
        $account = $this->request->param('login_account');
        $password = $this->request->param('login_password');

        try {
            if (is_null($account) || is_null($password)) {
                throw new HttpException(405, 'params not exists');
            }
        } catch (Exception $e) {
            return json('');
        }
    }

}
