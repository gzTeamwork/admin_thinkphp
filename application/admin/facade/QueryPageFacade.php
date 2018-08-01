<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/8/1
 * Time: 下午1:42
 */

namespace app\admin\facade;

use think\Facade;

class QueryPageFacade extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\admin\middleware\mwQueryPage';
    }
}