<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/7/24
 * Time: 下午4:09
 */

namespace app\inforward\controller;

use app\admin\apiHandler\CateApiHandler;
use app\admin\middleware\mwApi;
use think\Controller;
use think\facade\Request;

class Cate extends Controller
{
    use mwApi, CateApiHandler;

    public function index()
    {

    }

    /**
     * @return \think\response\Json
     */
    public function api()
    {
        $datas = Request::param();
        return mwApi::api($this, $datas);
    }
}