<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/21
 * Time: 下午4:55
 */

namespace app\inforward\unit;

use think\facade\Cookie;

/**
 * 用户单元
 * Class userUnit
 * @package app\inforward\unit
 */
class userUnit
{
    public $token;
    public $info;

    /**
     * 实例初始化
     * userUnit constructor.
     */
    public function __construct()
    {
        $this->token = $this->initToken(time());
        $this->info = [];
    }

    /**
     * 生成用户令牌
     * @param null $sign
     * @return string
     */
    public function initToken($sign = null)
    {
        if (Cookie::has('user_token', 'inforward_')) {
            $token = Cookie::get('user_token', 'inforward_');

        } else {
            //  创建新的用户令牌
            $token = $this->buildToken($sign);
        }

        $this->token = $token;

        return $token;
    }

    /**
     * 创建用户令牌
     * @param $sign
     * @return string
     */
    public function buildToken($sign)
    {
        $token = md5('inforward_' . $sign);
        Cookie::set('user_token', $token, ['prefix' => 'inforward_']);
        return $token;
    }

    /**
     * 是否admin
     * @return bool|mixed
     */
    public function isAdmin()
    {
        return in_array('admin', $this->info) ? $this->info['admin'] : false;
    }
}