<?php

namespace app\admin\middleware;

use think\facade\Cache;

trait mwUser
{

    public static function buildToken(string $sid = null)
    {
        $token = base64_encode(mwUserUid::buildUid($sid));
        return $token;
    }

    public static function buildUid(string $sid = null)
    {
        $uid = md5($sid ?? session_id());
        return $uid;
    }

    public static function getUserCache($uid)
    {
        return Cache::tag('visitors')->get($uid);
    }
    public static function saveUserCache(array $user, $uid)
    {
        return Cache::tag('visitors')->set($uid, $user);
    }

    public static function getUserByUid(array $userInfo)
    {
        $uid = $userInfo['uid'] ?? false;
        return $uid;
    }

}
