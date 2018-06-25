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

    public function api()
    {
        header("Access-Control-Allow-Origin:*");
        $api = Request::param('api', null);
        try {
            if (is_null($api) === false && method_exists($this, $api)) {
                $this->$api();
            } else {
                throw new Exception('不存在该api接口', 403);
            }
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}