<?php
namespace app\inforward\logic;

use app\inforward\model\UserSubmitModel;
use think\Exception;
use think\exception\HttpException;

class UserSubmitLogic
{
    public $db = null;

    public function __construct()
    {
        $this->db = new UserSubmitModel();
    }

    //  获取多条用户提交记录
    public function getSubmits($where = [], $limit = 500)
    {
        try {
            isset($where['group']) ?: $where['group'] = ['group', '=', 'none'];
            $submits = $this->db->where($where)->limit($limit)->select();
            return is_null($submits) ? null : $submits->toArray();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //  添加或更新记录
    public function insertSubmit(array $data)
    {
        $data['update_time'] = date('Y-m-d H:i:s', time());
        $data['enable'] = true;
        try {
            //  检查data是否包含条目id
            if (isset($data['id'])) {
                //  更新
                $id = $data['id'];
                unset($data['id']);
                $res = $this->db->allowField(true)->save($data, ['id' => $id]);
            } else {
                $data['create_time'] = date('Y-m-d H:i:s', time());
                $res = $this->db->allowField(true)->create($data);
            }
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //  添加单挑用户提交记录
    public function addSubmit($data)
    {
        $data['update_time'] = date('Y-m-d', time());
        $data['enable'] = true;

        try {
            $res = $this->db->allowField(true)->create($data);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //  添加多条用户提交记录
    public function addSubmits($list)
    {
        try {
            $res = $this->db->saveAll($list);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //  查找并更新用户提交记录
    public function updateSubmits($data)
    {
        if (isset($data['id'])) {
            $id = $data['id'];
            unset($data['id']);
            $res = $this->db->allowField(true)->save($data, ['id' => $id]);
            return $res;
        } else {
            throw new HttpException(600, "更新用户记录操作缺少记录id");
        }
    }
}
