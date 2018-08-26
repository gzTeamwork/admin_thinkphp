<?php

namespace app\admin\unit\user;

use app\admin\middleware\mwUser;
use think\Exception;

/**
 * 管理员
 * Class adminUserClass
 * @package app\admin\unit\user
 */
class adminUserClass extends userClass
{

    /**
     * adminUserClass constructor.
     * @param string|null $uid
     * @param $userInfo
     * @throws Exception
     */
    public function __construct($uid = null, $userInfo)
    {
        //  初始化uid
        $this->uid = $uid ?? mwUser::buildUid(mwUser::buildUid());
        $userCache = mwUser::getUserCache($this->uid);
        if (false !== $userCache) {
            $this->data = $userInfo;
//            $this->data = $this->_init_visitor($uid);
        } else {
            throw new Exception('当前用户无法被确定,请重新登录');
        }
    }

    public function firstAccess()
    {
        $this->data = $this->data['access_time'] ?? time();
        return $this;
    }

    function init($userInfo)
    {
        // TODO: Implement init() method.
    }
}
