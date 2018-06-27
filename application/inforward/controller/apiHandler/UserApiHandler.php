<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/27
 * Time: 下午2:28
 */

namespace app\inforward\controller\apiHandler;

use app\inforward\middleware\base\mwApi;
use think\Exception;

trait UserApiHandler
{
    use mwApi;

    /**
     * 数据接口 - 用户注册
     */
    public function api_user_register()
    {
        try {
            $account = mwApi::_api_getParam('account');
            if (is_null($account)) throw  new  Exception('缺少注册账户');
        } catch (Exception $exception) {
            $this->error($exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }
}