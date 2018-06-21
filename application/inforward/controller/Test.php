<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/19
 * Time: 上午11:51
 */

namespace app\inforward\controller;

use think\Controller;

class Test extends Controller
{
    /**
     * 测试后台首页
     * @return mixed
     */
    public function index()
    {
        return $this->fetch('test/index');
    }
}