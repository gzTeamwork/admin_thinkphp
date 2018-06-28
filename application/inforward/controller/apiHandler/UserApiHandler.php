<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/27
 * Time: 下午2:28
 */

namespace app\inforward\controller\apiHandler;

use app\inforward\model\user\usersModel;
use think\Exception;

trait UserApiHandler
{

    /**
     * 数据接口 - 用户注册
     */
    public function api_user_register()
    {
        try {
            $account = $this->GetParam('account');
            if (is_null($account)) throw  new  Exception('缺少注册账户');
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
            $account = $this->GetParam('account', null, true);
            $password = $this->GetParam('password', null, true);

            if (is_null($account) || is_null($password)) {
                throw new Exception('缺少必要参数', 403);
            } else {
                //  验证帐密
                if ($account == 'admin' && $password == '123456') {
                    $this->success('后台账户' . $account . '成功登录', '', ['nick_name' => '管理员', 'account' => 'admin', 'isAdmin' => true]);
                } else {
                    throw new Exception('后台账户或密码错误');
                }
            }

        } catch (Exception $exception) {
            $this->error('后台登陆失败', '', ['msg' => $exception->getMessage()]);
        }
    }
}