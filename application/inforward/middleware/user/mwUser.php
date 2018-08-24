<?php

/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/21
 * Time: 下午4:47
 */

namespace app\inforward\middleware\user;

use app\inforward\model\user\userModel;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\Exception;

/**
 * 用户缓存中间件
 * Trait mwUser
 * @package app\inforward\logic\user
 */
trait mwUser
{

    /**
     * 生成用户唯一id
     * @return bool|string
     */
    static public function buildUnionId()
    {
        /*
         * Use OpenSSL (if available)
         */
        $length = 20;
        if (function_exists('openssl_random_pseudo_bytes')) {
            $bytes = openssl_random_pseudo_bytes($length * 2);

            if ($bytes === false)
                throw new RuntimeException('Unable to generate a random string');

            return substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $length);
        }

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
        //        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@_';
        //        $random = substr(str_shuffle($chars), 0, 12) . time();
        //        return $random;
    }

    /**
     * 新增一个新用户
     * @param array $user
     * @throws Exception
     */
    static public function insertUser(Array $user)
    {
        //  生成唯一id
        $user['union_id'] = self::buildUnionId();
        //  生成密码
        $user['password'] = md5($user['password']);
        $user['nick_name'] = $user['account'];
        $userModel = new userModel();
        try {
            $res = $userModel->where('account', '=', $user['account'])->select();
            $res = $userModel->getResult($res);
        } catch (ModelNotFoundException $exception) {
            unset($exception);
            return $userModel->allowField(true)->save($user);
        }
        throw new Exception('新注册的用户已经存在' . $user['account']);
    }

    /**
     * 查找一个用户
     * @param array $where
     * @return null
     * @throws DataNotFoundException
     * @throws \think\exception\DbException
     */
    static public function findUser(Array $where)
    {
        $userModel = new userModel();
        try {
            //  密码加密处理
            if (isset($where['password'])) {
                $where['password'] = md5($where['password']);
            }
            //  是否只检索活动帐号
            if (isset($where['active'])) {
                $where['active'] = 1;
            }

            $where = $userModel->fieldsFilter($userModel->getTableFields(), $where);
//            var_dump($where);

            $res = $userModel->where($where)->select();
            $res = $userModel->getResult($res);
            return $res[0];
        } catch (ModelNotFoundException $exception) {
//            var_dump($userModel->getLastSql());
        }
    }

    /**
     * 创建一个空的用户模型
     * @return array|null
     */
    static public function createEmptyUser()
    {
        $userModel = new userModel();
        $fields = $userModel->getTableFields();
        $userEmpty = array_map(function ($v) {
            $v = null;
        }, array_flip($fields ?: []));
//        var_dump($userEmpty);
        return $userEmpty;
    }

    /**
     * 创建一个访客用户
     */
    static public function createVisitor()
    {
        $userTemplate = self::createEmptyUser();
        $userTemplate['nick_name'] = '访客';
        $userTemplate['isAdmin'] = false;
        $userTemplate['isActive'] = true;
        $userTemplate['create_time'] = $userTemplate['update_time'] = time();
        return $userTemplate;
    }

    /**
     * 获取多个用户信息
     * @param array $where
     * @return array
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @throws \think\exception\DbException
     */
    static public function getUsers(array $where)
    {
        $userModel = new userModel();
        $where = $userModel->fieldsFilter($userModel->getTableFields(), $where);
//        $where = $userModel->fieldsNeed(['isActive' => 1], $where);
        $users = $userModel->where($where)->select();
        $users = $userModel->getResult($users);
        return $users;
    }


}