<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/27
 * Time: 下午2:28
 */

namespace app\inforward\controller\apiHandler;

use app\inforward\middleware\user\mwUser;
use app\inforward\model\user\usersModel;
use think\Exception;
use think\facade\Request;

trait UserApiHandler
{
    public function testUser()
    {
        $user = mwUser::createVisitor();
        var_dump($user);
    }

    /**
     * 数据接口 - 用户注册
     */
    public function api_user_register()
    {
        try {
            $params = Request::param();
            $params['account'] = $this->getParam('account', null, true);
            $params['email'] = $this->getParam('email', null, true);
            $params['password'] = $this->getParam('password', null, true);
            $res = mwUser::insertUser($params);
//            var_dump($res);
            $this->success('成功注册新用户' . $params['account'], '', ['data' => $params]);
        } catch (Exception $exception) {
            $this->error($exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * 数据接口 - 用户登录
     */
    public function api_user_login()
    {
        $userCenterModel = new usersModel();
        try {
            //  账户 & 密码
            $params = Request::param();
            $params['account'] = $this->GetParam('account', null, true);
            $params['password'] = $this->GetParam('password', null, true);

            //  验证帐密
            $res = mwUser::findUser($params);
//            var_dump($res);
            if (is_null($res)) {
                throw new Exception($params['account'] . '用户登录失败!');
            } else {
                $this->success($params['account'] . '用户登录成功', '', $res);
            }
//            if ($account == 'admin' && $password == '123456') {
//                $this->success('后台账户' . $account . '成功登录', '', ['nick_name' => '管理员', 'account' => 'admin', 'isAdmin' => true]);
//            } else {
//                throw new Exception('后台账户或密码错误');
//            }

        } catch (Exception $exception) {
            $this->error('后台登陆失败', '', ['msg' => $exception->getMessage()]);
        }
    }
}