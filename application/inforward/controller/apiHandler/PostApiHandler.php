<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-24 0024
 * Time: 7:56
 */

namespace app\inforward\controller\apiHandler;

use app\inforward\model\post\PostExtraModel;
use app\inforward\model\post\PostModel;
use app\inforward\model\post\PostTemplateModel;
use Symfony\Component\Validator\Constraints\Date;
use think\Exception;

trait PostApiHandler
{
//    private function _paramBeforeGet(&$datas)
//    {
//        $datas['limit'] = $data['limit'] ?? 20;
//        $datas['page'] = $data['page'] ?? 1;
//        return $datas;
//    }

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

    public function api_post_get_detail($datas)
    {
        try {
            $postModel = new PostModel();
            $pid = $datas['pid'] ?? false;
            if (false === $pid) {
                throw new Exception("没有获取到正确的参数");
            }
            $postModel->alias('p')->leftJoin('posts_extra pe', 'p.id = pe.pid');
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
            $result = $postModel->where($datas)->select();
            $result = $postModel->getResult($result);
            return $result;
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    public function api_posts_get_detail($datas)
    {
        try {
            $postModel = new PostModel();
//            $postModel->alias('p')->join('posts_extra pe','p.id = pe.pid');
            $result = $postModel->with('postExtras')->where($datas)->select();
            $result = $postModel->getResult($result);
            $this->success('获取文章详情数据成功', '', $result);
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    /**
     * @param $datas
     * @return void
     * @throws \Exception
     */
    public function api_post_set($datas)
    {
        try {
            $postModel = new PostModel();
            $datas['create_time'] = date('Y-m-d H:i:s', isset($data['create_time']) ? $datas['create_time'] : time());
            $datas['update_time'] = $datas['create_time'];
            $result = $postModel->allowField(true)->data($datas)->save();
            $npid = $postModel->getLastInsID();
            var_dump(count($datas['extraList']));
            if ($result === 1 && count($datas['extraList']) > 1) {
                //  成功添加了,处理文章附加内容
                $postExtraModel = new PostExtraModel();
                foreach ($datas['extraList'] as $key => $ex) {
                    $datas['extraList'][$key]['pid'] = $npid;
                }
                var_dump($datas['extraList']);
                $postExtraModel->allowField(true)->saveAll($datas['extraList']);
            }
            $this->success('成功发布新的文章', '', $npid);
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    /**
     * @param $datas
     * @return int
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

    /**
     * post template - 文章模板api
     */

    public function api_post_templates_get()
    {
        try{
            $postTempModel = new PostTemplateModel();
            $result = $postTempModel->select();
        }
    }
}