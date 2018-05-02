<?php
namespace app\inforward\logic;

//  管理员逻辑类
class AdminLogic
{

    //  检查用户是否为管理员
    public function isAdmin($user = null)
    {
        return issset($user['isAdmin']) ? $user['isAdmin'] === true : flase;
    }

}
