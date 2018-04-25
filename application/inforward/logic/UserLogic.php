<?php

namespace app\inforward\logic;

use app\inforward\model\UserModel;
use think\exception\HttpException;

class UserLogic
{

    //  实例化users模型类

    private function _getUserModel()
    {
        return $userModel = new UserModel();
    }

    private function _getUserQuery($params, $limit = 200)
    {
        try {
            $db = new UserModel();

            $params = $this->getParams($params);
            dump($params);
            // $userModel->where(array_values($params));
            // dump($params);
            $db->where($params);
            $users = $db->select();

            if ($users == null) {
                //  没有找到对应数据
                return null;
            } else {
                return $users->toArray();
            }
            return $users;

        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //  合并查询参数和默认查询参数
    public function getParams($params = null)
    {
        isset($params['isWorking']) ?: $params['isWorking'] = ['isWorking', '=', 1];
        return $params;
    }

    //  查询复数用户

    public function getUsers($params = null, $limit = 200)
    {
        $params = $this->getParams($params);
        // dump($params);
        $userModel = new UserModel();
        $users = $userModel->where($params)->select();
        return is_null($users) ? null : $users->toArray();
    }

    //  查询单个用户
    public function getUser($params)
    {
        $user = $this->_getUserQuery($params, 1);
        return $user;
    }

    //  更新单个用户信息
    public function updateUser($where, $data)
    {
        $userModel = new UserModel();
        $curUser = $userModel->where($where)->find();
        if (is_null($curUser)) {
            throw new HttpException(404, '不存在更新用户');
        } else {
            $userModel = new UserModel();
            $curUser = $userModel->allowField(true)->save($data, $where);
        }
        return $curUser;
    }

    public function updateUserById($userid, $data)
    {
        return $this->updateUser([['userid', '=', $userid]], $data);
    }
}
