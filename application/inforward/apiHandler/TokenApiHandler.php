<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/8/8
 * Time: 下午3:41
 */

namespace app\inforward\apiHandler;

use app\inforward\model\user\userSessionModel;
use think\Exception;
use think\facade\Session;

trait TokenApiHandler
{
    /**
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function api_get_access_token()
    {
        try {
            Session::start();

            $userSessionModel = new userSessionModel();
            $sid = session_id();
            $existSession = $userSessionModel->where('session_id', $sid)->cache(true)->find();

            if ($existSession) {
                $userToken = ['uid' => $existSession['uid'], 'token' => $existSession['token']];
            } else {
                $userToken = ['uid' => base64_encode($sid), 'token' => md5($sid)];
                $userSessionModel->save(array_merge($userToken, ['session_id' => $sid]));
            }

            $result = $userToken;
            $successMsg = '成功生成用户token';
            $this->success($successMsg, '', $result);
        } catch (Exception $exception) {
            $errorMsg = '';
            $this->error($errorMsg ?? $exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }
}