<?php

namespace app\inforward\controller;

use think\Controller;
use think\Request;

class Admin extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function dashboard()
    {
        //  后台首页

    }

}
