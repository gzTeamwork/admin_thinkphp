<?php

namespace app\admin\unit\user;


use app\admin\middleware\mwUser;

class visitorClass extends userClass
{

    private function _init_visitor($uid)
    {
        $data['uid'] = $uid;
        $data['nick_name'] = '游客';
        $data['access_time'] = time();
        $data['is_admin'] = false;
        $data['role'] = 0;
        return $data;
    }

    public function __construct($uid, $userInfo)
    {
        parent::__construct($uid, $userInfo);
    }

    function firstAccess()
    {
        // TODO: Implement firstAccess() method.
    }
}

