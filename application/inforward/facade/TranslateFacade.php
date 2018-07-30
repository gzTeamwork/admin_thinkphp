<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/7/31
 * Time: 下午7:00
 */

namespace app\inforward\facade;

use think\Facade;

class TranslateFacade extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\inforward\middleware\mwTranslate';
    }
}