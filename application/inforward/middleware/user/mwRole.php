<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/7/2
 * Time: 下午1:44
 */

namespace app\inforward\middleware\user;

use app\inforward\model\user\roleModel;
use think\db\exception\ModelNotFoundException;
use think\Exception;

trait mwRole
{
    /**
     * 获取权限列表
     * @param array $where
     * @return array
     */
    static public function getRoles(array $where = [])
    {
        try {
            $roleModel = new roleModel();
            $where = $roleModel->fieldsNeed(['is_active' => 1], $where);
            $res = $roleModel->where($where)->select();
            $res = $roleModel->getResult($res);
            return $res;
        } catch (Exception $exception) {
            var_dump($exception->getMessage(), $roleModel->getLastSql());
        }
    }

    /**
     * 获取权限字段
     * @return array|null
     */
    static public function getRoleFields()
    {
        try {
            $roleModel = new roleModel();
            $res = $roleModel->getTableFields();
            return $res;
        } catch (Exception $exception) {
            var_dump($exception->getMessage(), $roleModel->getLastSql());
        }
    }

    /**
     * 增加新的权限角色
     * @param $datas
     * @throws Exception
     */
    static public function setNewRole($datas)
    {
        try {
            $roleModel = new roleModel();
            $res = $roleModel->where('name', '=', $datas['name'])->select();
            $res = $roleModel->getResult($res);
        } catch (ModelNotFoundException $exception) {
            unset($exception);
            var_dump($datas);
            return $roleModel->allowField(true)->save($datas);
        }
        throw new Exception('已存在相应的权限角色名');

    }
}