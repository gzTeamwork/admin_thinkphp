<?php

/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/21
 * Time: 下午4:47
 */

namespace app\inforward\middleware\user;

use app\inforward\controller\User;
use app\inforward\model\user\usersModel;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\Exception;
use think\facade\Cache;
use think\facade\Session;

/**
 * 用户缓存中间件
 * Trait mwUser
 * @package app\inforward\middleware\user
 */
trait mwUser
{

    /**
     * 生成用户唯一id
     * @return bool|string
     */
    static public function buildUnionId()
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@_';
        $random = substr(str_shuffle($chars), 0, 12) . time();
        return $random;
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
        $userModel = new usersModel();
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
        $userModel = new usersModel();
        try {
            if (isset($where['password'])) {
                $where['password'] = md5($where['password']);
            }

            $where = $userModel->filterFields($userModel->getTableFields(), $where);
            var_dump($where);

            $res = $userModel->select($where);
            return $res = $userModel->getResult($res);
        } catch (ModelNotFoundException $exception) {

        }
    }

    /**
     * 创建一个空的用户模型
     * @return array|null
     */
    static public function createEmptyUser()
    {
        $userModel = new usersModel();
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


}