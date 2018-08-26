<?php

namespace app\admin\unit\user;

use app\admin\middleware\mwUser;

abstract class userClass
{

    public $uid = null;
    public $data = [];

    //  用户实例必须有的字段
    protected $mustFields = ['nick_name' => '', 'is_admin' => false, 'role' => 0, 'uid' => null];


    abstract protected function __construct($uid, $userInfo);

    /**
     * @param $uid
     */
    protected function init($uid)
    {

    }


}
