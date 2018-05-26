<?php

namespace app\inforward\facade;

use think\Facade;

class QrcodeLogicFacade extends Facade{
    protected static function getFacadeClass()
    {
        return 'app\inforward\logic\QrcodeLogic';
    }
}