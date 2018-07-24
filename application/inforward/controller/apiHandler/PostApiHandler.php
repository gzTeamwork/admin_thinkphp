<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-24 0024
 * Time: 7:56
 */

namespace app\inforward\controller\apiHandler;

use app\inforward\model\post\PostModel;
use think\Exception;
use think\facade\Request;

trait PostApiHandler
{
    private function _paramBeforeGet(&$datas)
    {
        $datas['limit'] = $data['limit'] ?? 20;
        $datas['page'] = $data['page'] ?? 1;
        return $datas;
    }

    /**
     * 获取文章
     * @throws Exception
     */
    public function api_post_get($datas)
    {
        try {
            $postModel = new PostModel();
            $pid = $datas['pid'] ?? false;
            if (false === $pid) {
                throw new Exception("没有获取到正确的参数");
            }
            $result = $postModel->where($datas)->find();
            $result = $postModel->getResult($result, '该id文章不存在');
            return $result;
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    /**
     * 获取多个文章
     * @param $datas
     * @return array|\PDOStatement|string|\think\Collection
     */
    public function api_posts_get($datas)
    {
        try {
            $postModel = new PostModel();
            $result = $postModel->where($datas)->allowField($datas)->select();
            $result = $postModel->getResult($result);
            return $result;
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    /**
     * @param $datas
     * @return bool
     */
    public function api_post_new($datas)
    {
        try {
            $postModel = new PostModel();
            $result = $postModel->allowField(true)->data($datas)->save();
            return $result;
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    /**
     * @param $datas
     * @throws \Exception
     */
    public function api_post_delete($datas)
    {
        try {
            $postModel = new PostModel();
            $result = $postModel->where('pid', '=', $datas['pid'])->delete();
            return $result;
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    public function api_post_remove($datas)
    {
        try {
            $postModel = new PostModel();
            $result = $postModel->save(['isActive', false], ['pid', $datas['pid']]);
            return $result;
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}