<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/27
 * Time: 下午2:28
 */

namespace app\admin\apiHandler;

use app\inforward\middleware\user\mwRole;
use app\inforward\middleware\user\mwUser;
use app\inforward\model\user\userModel;
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
        $userCenterModel = new userModel();
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
                $res['password'] ?? array_pop($res['password']);
                $this->success($params['account'] . '用户登录成功', '', $res);
            }

        } catch (Exception $exception) {
            $this->error('后台登陆失败', '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * 数据接口 - 获取用户列表
     */
    public function api_get_user_list()
    {
        try {
            $userList = mwUser::getUsers([]);
            $this->success('成功获取多个用户信息', '', $userList);
        } catch (Exception $exception) {
            $this->error('获取多个用户信息失败', '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * 数据接口 - 获取权限列表
     */
    public function api_get_role_list()
    {
        try {
            $roleList = mwRole::getRoles([]);
            $this->success('成功获取权限列表', '', $roleList);
        } catch (Exception $exception) {
            $this->error('获取权限列表失败', '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * 数据接口 - 获取权限角色字段
     */
    public function api_get_role_fields()
    {
        try {
            $roleFields = mwRole::getRoleFields();
            $this->success('成功获取权限字段', '', $roleFields);
        } catch (Exception $exception) {
            $this->error('获取字段失败', '', ['msg' => $exception->getMessage()]);
        }
    }

    public function api_set_new_role()
    {
        try {
            $datas = Request::param();
            $res = mwRole::setNewRole($datas);
            $this->success('成功增加新的权限角色', '', $res);
        } catch (Exception $exception) {
            $this->error($exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }
}