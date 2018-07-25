<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/7/24
 * Time: 下午4:11
 */

namespace app\inforward\controller\apiHandler;

use app\inforward\model\cate\CateModel;
use Symfony\Component\Validator\Constraints\Date;
use think\Exception;

trait CateApiHandler
{

    /**
     * 获取单个栏目
     */
    public function api_cate_get(&$datas)
    {
        try {
            $cateModel = new CateModel();
            $result = $cateModel->where('id', '=', $datas['id'])->find();
            $result = $cateModel->getResult($result, true, '查找的栏目不存在');
            $this->success('获取单个栏目信息成功', '', $result);
        } catch (Exception $exception) {
            $this->error('获取单个栏目失败', '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * 获取多个cate
     * @param $datas
     * @return array|null|\PDOStatement|string|\think\Collection
     */
    public function api_cates_get(&$datas)
    {
        try {
            $cateModel = new CateModel();
            $datas = $cateModel->fieldsFilterByDataTable($datas);
            $result = $cateModel->where($datas)->select();
            $result = $cateModel->getResult($result, false);
            $this->success('获取多个栏目信息成功', '', $result);
        } catch (Exception $exception) {
            $this->error('获取多个栏目失败', '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * 移除栏目
     * @param $datas
     * @return void
     */
    public function api_cate_remove(&$datas)
    {
        try {
            $cateModel = new CateModel();
            if (isset($datas['id'])) {
                throw new Exception('没有参数');
            }
            $result = $cateModel->save(['is_active', '=', 0], ['id', '=', $datas['id']]);
            $result = $cateModel->getResult($result);
            $this->success('删除栏目成功', '', $result);
        } catch (Exception $exception) {
            $this->error('删除栏目失败', '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * @param $datas
     */
    public function api_cate_set(&$datas)
    {
        try {
            $cateModel = new CateModel();
            $datas['pid'] = $datas['pid'] ?? 0;
            $datas = $cateModel->fieldsNotNull($datas, ['title', 'name']);
            $datas['create_time'] = date("Y-m-d H:i:s", time());
            $datas['is_active'] = true;
            $result = $cateModel->data($datas)->allowField(true)->save();
            if ($result) {
                $result = $cateModel->where('name', 'eq', $datas['name'])->find();
            }
            $this->success('成功增加新栏目' . $datas['title'], '', $result);
        } catch (Exception $exception) {
//            var_dump($exception->getMessage(), $cateModel->getLastSql());
            $this->error('增加栏目失败', '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * 栏目更新
     * @param $datas
     * @return false|int
     */
    public function api_cate_update(&$datas)
    {
        try {
            if (isset($datas['id'])) {
                throw new Exception('无法确定修改的栏目');
            } else {
                $cid = $datas['id'];
                unset($datas['id']);
            }
            if (isset($datas['create_time'])) unset($datas['create_time']);
            $datas['update_time'] = time();
            $cateModel = new CateModel();
            $result = $cateModel->allowField(true)->save($datas, ['id', '=', $cid]);
            return $result;
        } catch (Exception $exception) {
            $this->error('更新栏目失败', '', ['msg' => $exception->getMessage()]);
        }
    }


}