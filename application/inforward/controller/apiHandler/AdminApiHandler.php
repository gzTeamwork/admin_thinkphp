<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/27
 * Time: 下午1:38
 */

namespace app\inforward\controller\apiHandler;

use app\inforward\middleware\base\mwApi;
use think\Exception;

trait AdminApiHandler
{
    use mwApi;

    /**
     * 数据接口 - 管理员登陆
     * @return \think\response\Json
     */
    public function api_admin_login()
    {
        try {
            $account = $this->getParam('account', null, true);
            $password = $this->getParam('password', null, true);
            if (is_null($account) || is_null($password)) {
                throw new Exception('缺少必要参数', 403);
            } else {
                if ($account == 'admin' && $password == '123456') {
                    $this->success('管理员' . $account . '成功登录', '', ['nick' => '管理员', 'account' => 'admin', 'isAdmin' => true]);
                } else {
                    throw new Exception('管理员账户或密码错误');
                }
            }
        } catch (Exception $exception) {
            $this->error('管理员登陆失败', '', ['msg' => $exception->getMessage()]);
        }

    }

}