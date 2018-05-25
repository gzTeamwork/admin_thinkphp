<?php

namespace \app\inforward\facade;

use think\Facade;

class WebsiteLogicFacade{
    protected static function getFacadeClass()
    {
        return 'app\inforward\logic\WebsiteLogic';
    }
}