<?php
namespace app\inforward\logic;

//  管理员逻辑类
class AdminLogic
{

    public function isAdmin($user = null)
    {
        return issset($user['isAdmin']) ? $user['isAdmin'] === true : flase;

    }

}
