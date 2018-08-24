<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/25
 * Time: 下午2:35
 */

namespace app\inforward\middleware\base;

use think\Controller;
use think\Exception;
use think\facade\Request;

/**
 * Trait mwApi
 */
trait mwApi
{

    /**
     * GetParam
     * 获取单个接口参数
     * @param $key
     * @param null $default
     * @param bool $isMust
     * @return mixed|null
     */
    static public function GetParam($key, $default = null, $isMust = false)
    {
        if ($isMust && Request::has($key)) {
            return $param = Request::param($key, $default);
        } else {
            new Exception("缺少接口参数:" . $key, 0);
            return $default;
        }
    }

    /**
     * 接口触发函数 - api
     * 根据do传入的接口数据,执行对应的api接口
     * 当接口不存在则抛出错误信息
     * @param Controller $c
     * @return \think\response\Json
     */
    static public function api(Controller $c, Array $datas = [])
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET, POST, PUT , DELETE');

        $apiDo = Request::route('do');

        try {
            if (is_null($apiDo) === false && method_exists($c, $apiDo) && Request::isAjax()) {
                unset($datas['do']);
                $c->$apiDo($datas);
            } else {
                throw new Exception('您本次的访问方式不被允许', 0);
            }
        } catch (Exception $exception) {
            // @todo 以后需要添加错误页面
            return json(['msg' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
    }

}