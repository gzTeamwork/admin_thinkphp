<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/8/8
 * Time: 下午3:41
 */

namespace app\admin\apiHandler;

use app\inforward\model\user\userSessionModel;
use think\Exception;
use think\facade\Cache;
use think\facade\Session;

trait TokenApiHandler
{


    /**
     * 获取token
     * @return mixed
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

            //  缓存访客uid和token
            Cache::set('inforward_visitor' . $userToken['uid'], $userToken['token'], 7200);
//            $uid = Cache::get('inforward_visitor' . $userToken['uid']);
//            dump($uid);

            $result = $userToken;
            $successMsg = '成功生成用户token';
            $this->success($successMsg, '', $result);

        } catch (Exception $exception) {
            $errorMsg = '';
            $this->error($errorMsg ?? $exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * 验证token
     * @param $params
     */
    public function api_valid_token($params)
    {
        try {
            if (isset($params['token'])) {
                $cacheToken = Cache::get('inforward_visitor' . $params['token'], false);
                if ($cacheToken !== false) {
                    $successMsg = '用户token通过验证';
                    $this->success($successMsg, '', $cacheToken);
                } else {
                    throw new Exception('用户token已经过期');
                }
            } else {
                throw new Exception('缺少访问token');
            }
        } catch (Exception $exception) {
            $errorMsg = '';
            $this->error($errorMsg ?? $exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }

}