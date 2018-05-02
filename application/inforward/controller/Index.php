<?php

/*
 * @Author: Zicokuo
 * @Date: 2018-04-07 17:12:52
 * @Last Modified by: Zicokuo
 * @Last Modified time: 2018-04-07 17:15:27
 */

namespace app\inforward\controller;

use think\Controller;

class Index extends Controller
{
    public function __construction()
    {
        parent::__construction();
    }

    public function index()
    {
        return "hello,this is inforward interface api enter;"; # code...
    }

    
}
