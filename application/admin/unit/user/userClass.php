<?php

namespace app\admin\unit\user;

use app\admin\middleware\mwUser;

abstract class userClass
{

    public $uid = null;
    public $data = [];

    public function __construct(string $uid = null)
    {
        //  初始化uid
        $this->uid = $uid ?? mwUser::buildUid(mwsessino_id());
        $this->data = mwUser::getUserCache($this->uid);
        if (false === $this->data) {
            $this->data = $this->_init_visitor($uid);
        }
    }

    private function _init_visitor($uid)
    {
        $data['uid'] = $uid;
        $data['nick_name'] = '游客';
        $data['access_time'] = time();
        $data['is_admin'] = false;
        $data['role'] = 0;
        return $data;
    }

    public function firstAccess()
    {
        $this->data = $this->data['access_time'] ?? time();
        return $this;
    }
}
