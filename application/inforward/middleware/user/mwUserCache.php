<?php

/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/21
 * Time: 下午4:47
 */

namespace app\inforward\middleware\user;

use think\facade\Session;
use think\facade\Cookie;

trait mwUserCache
{
    public function getUser($uid)
    {
        return Session::has($uid) ? Session::get($uid, 'inforward') : null;
    }

}