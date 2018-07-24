<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-24 0024
 * Time: 8:10
 */

namespace app\inforward\controller;

use app\inforward\controller\apiHandler\PostApiHandler;
use app\inforward\middleware\base\mwApi;
use think\Controller;
use think\Exception;
use think\facade\Request;

class Post extends Controller
{
    use mwApi, PostApiHandler;

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