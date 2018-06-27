<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/25
 * Time: 下午2:35
 */

namespace app\inforward\middleware\base;

use think\Exception;
use think\facade\Request;

/**
 * Trait mwApi
 */
trait mwApi
{
    use \traits\controller\Jump;

    /**
     * _api_getParam
     * 获取单个接口参数
     * @param $key
     * @param null $default
     * @param bool $isMust
     * @return mixed|null
     */
    private function _api_getParam($key, $default = null, $isMust = false)
    {
        if ($isMust && Request::has($key)) {
            return $param = Request::param($key, $default);
        } else {
            new Exception("缺少接口参数:" . $key, 404);
            return $default;
        }
    }

    public function api()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE');
        $apiIO = Request::route('io');
//        var_dump($apiIO);
        try {
            if (is_null($apiIO) === false && method_exists($this, $apiIO)) {
                $this->$apiIO();
            } else {
                throw new Exception('不存在该api接口', 303);
            }
        } catch (Exception $exception) {
            $this->error($exception->getMessage(), '', ['code' => $exception->getCode(), 'msg' => $exception->getMessage()]);
        }
    }
}