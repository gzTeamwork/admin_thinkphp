<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/27
 * Time: 下午2:27
 */

namespace app\inforward\controller;


use app\inforward\controller\apiHandler\UserApiHandler;
use app\inforward\middleware\base\mwControllerBase;
use think\Controller;

class User extends Controller
{
    use mwControllerBase;
    use UserApiHandler;

}