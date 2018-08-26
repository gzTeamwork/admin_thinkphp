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
     * showdoc
     * @catalog 用户接口/用户令牌
     * @title 获取用户令牌
     * @description 获取用户访问token,一般用于第一次访问网站时候调用,如带有token参数则返回新的用户token,用于前端页面更新
     * @method get
     * @url [hostname]/inforward/admin/api/do/api_get_access_token
     * @param token 可选 string 用户token
     * @return {
     * "code": 1,
     * "msg": "成功生成用户token",
     * "data":{
     * "uid": "MjM2Njc2ODUwMzM4ZTBiOGE0ZmU0NWQ3NjVhNTZiOWM=",
     * "token": "feed5b731e0a8c1b01060991e5c7cf2b"
     * },
     * "url": "",
     * "wait": 3
     * }
     * @return_param uid string 用户唯一id
     * @return_param token string 用户令牌
     * @remark 管理后台实际上会保存用户生成的token到数据库
     * @number 99
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
            Cache::tag('inforward_visitor')->set('inforward_visitor' . $userToken['token'], $userToken['uid'], 3600 * 30);

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
     * showdoc
     * @catalog 用户接口/用户令牌验证
     * @title 用户令牌验证
     * @description 用于验证用户令牌
     * @method get
     * @url [hostname]/inforward/admin/api/do/api_get_access_token
     * @param token 必选 string 用户令牌
     * @return {}
     * @return_param token string 用户令牌
     * @remark
     * @number 99
     */
    public function api_valid_token($params)
    {
        try {
            if (isset($params['token'])) {
                $cacheToken = Cache::tag('inforward_visitor')->get('inforward_visitor' . $params['token'], false);
                if ($cacheToken !== false) {
                    $successMsg = '用户token通过验证';
                    $this->success($successMsg, '', ['token' => md5(base64_decode($cacheToken))]);
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