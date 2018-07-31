<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-24 0024
 * Time: 7:56
 */

namespace app\inforward\controller\apiHandler;

use app\inforward\facade\TranslateFacade;
use app\inforward\middleware\mwQueryPage;
use app\inforward\model\post\PostExtraModel;
use app\inforward\model\post\PostModel;
use app\inforward\model\post\PostTemplateModel;
use think\Exception;

trait PostApiHandler
{

    /**
     * 获取文章
     * @throws Exception
     */
    public function api_post_get($datas)
    {
        try {
            $postModel = new PostModel();
            if (isset($datas['id'])) {
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
     * @param $datas
     */
    public function api_post_get_detail($datas)
    {
        try {
            $postModel = new PostModel();
            $pid = $datas['id'] ?? false;
            if (false === $pid) {
                throw new Exception("没有获取到正确的参数");
            }
            $result = $postModel->with('postExtra')->where($datas)->select();
//            var_dump($result);
            $result = $postModel->getResult($result, '该id文章不存在');
            $postTemplate = PostTemplateModel::get(['name' => $result[0]['kind']]);
            $postTemplateData = array_combine(array_column($result[0]['post_extra'], 'name'), $result[0]['post_extra']);
            $postTemplateFormat = array_combine(array_column($postTemplate->content, 'name'), $postTemplate->content);
            $result[0]['post_extra_format'] = $postTemplateFormat;

            $postTemplateData = array_values(array_merge($postTemplateFormat, $postTemplateData));
            $result[0]['post_extra'] = $postTemplateData;
            $this->success('成功获取当前文章', '', $result[0]);
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
            $result = $postModel->with('postExtra')->where($datas)->select();
            $result = $postModel->getResult($result);

            $this->success('获取文章详情数据成功', '', $result);
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    /**
     * @param $datas
     */
    public function api_posts_get_detail_list($datas)
    {
        try {

            $postModel = (new PostModel())->with('postExtra');

            $postQueryDatas = array_intersect_key($datas, array_flip($postModel->getTableFields()));
            $postExtraQueryDatas = array_diff_key($datas, array_flip($postModel->getTableFields()));
            $pageQueryDatas = mwQueryPage::getQueryPage($datas);
//            var_dump($pageQueryDatas);
            $result = $postModel->where($postQueryDatas)->page($pageQueryDatas['page'], $pageQueryDatas['perPage'])->select();
            foreach ($result as $key => $post) {
                $result[$key]['title'] = \app\inforward\facade\TranslateFacade::c2t($post['title']);
                $result[$key]['content'] = \app\inforward\facade\TranslateFacade::c2t($post['content']);
                foreach ($post['post_extra'] as $kkey => $extra) {
                    //  数据输出过滤
                    if (array_key_exists($extra['name'], $postExtraQueryDatas) && $extra['value'] != $postExtraQueryDatas[$extra['name']]) {
                        unset($result[$key]);
                        break;
                    }
                    switch ($extra['type']) {
                        case 'datetime':
                            $value = date('Y年m月d日', strtotime($extra['value']));
                            break;
                        case 'array':
                            $value = json_decode($extra['value']);
                            break;
                        default:
                            $value = $extra['value'];
                    }
                    $result[$key][$extra['name']] = \app\inforward\facade\TranslateFacade::c2t($extra['value']);
//                    $result[$key][$extra['name']] = $value;
                }
            }
            $this->success('获取文章详情数据成功', '', $result);
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

//    个体化api

    /**
     * @param $datas
     */
    public function api_posts_get_office($datas)
    {
        $datas['kind'] = 'office_unit';
        return $this->api_posts_get_detail_list($datas);
    }

    public function api_posts_get_department($datas)
    {
        $datas['kind'] = 'yu_department';
        return $this->api_posts_get_detail_list($datas);
    }

    /**
     * 发布新文章
     * @param $datas
     * @return void
     * @throws \Exception
     */
    public function api_post_set($datas)
    {
        try {
            $postModel = new PostModel();
            if (isset($datas['id']) && PostModel::get($datas['id'])) {
//                更新文章
                unset($datas['update_time']);
//                var_dump($datas);

                $datas['create_time'] = date('Y-m-d H:i:s', strtotime($datas['create_time']));
                $id = $datas['id'];
                $result = $postModel->allowField(true)->data($datas)->isUpdate(true, ['id' => $id])->save();
                if ($result !== false && isset($datas['extraList'])) {
                    $postExtraModel = new PostExtraModel();
                    foreach ($datas['extraList'] as $key => $ex) {
                        $datas['extraList'][$key]['pid'] = $id;
                    }
                    $postExtraModel->saveAll($datas['extraList']);
                }
                $this->success('成功更新了文章', '', $id);

            } else {
                $datas['create_time'] = date('Y-m-d H:i:s', isset($data['create_time']) ? $datas['create_time'] : time());
                $result = $postModel->allowField(true)->data($datas)->save();
                $npid = $postModel->getLastInsID();
//            var_dump(count($datas['extraList']));
                if ($result === 1 && count($datas['extraList']) > 1) {
                    //  成功添加了,处理文章附加内容
                    $postExtraModel = new PostExtraModel();
                    foreach ($datas['extraList'] as $key => $ex) {
                        $datas['extraList'][$key]['pid'] = $npid;
                    }
//                var_dump($datas['extraList']);
                    $postExtraModel->allowField(true)->saveAll($datas['extraList']);
                }
                $this->success('成功发布新的文章', '', $npid);
            }
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    /**
     * @param $datas
     * @return int
     * @throws \Exception
     * @todo add checkout is safe del
     */
    public function api_post_del($datas)
    {
        try {
            if (isset($datas['id']) && PostModel::get($datas['id'])) {
                $result = (new PostModel)->where('id', '=', $datas['id'])->delete();
//                $result = $postModel->allowField(true)->save(['is_active' => 0], ['id' => $datas['id']]);
                if ($result) {
                    (new PostExtraModel)->where('pid', '=', $datas['id'])->delete();
                    return $this->success('成功删除文章', $result);
                } else {
                    throw new Exception('文章删除操作失败');
                }
            } else {
                throw new Exception('文章删除缺少必要参数');
            }
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
        try {
            $postTempModel = new PostTemplateModel();
            $result = $postTempModel->select();
            $this->success('成功获取文章模板', '', $result);
        } catch (Exception $exception) {
            $this->error('获取文章模板失败', '');
        }
    }

    public function api_post_template_set($datas)
    {
        try {
            $postTempModel = new PostTemplateModel();
            $result = $postTempModel->allowField(true);
            $datas['content'] = json_encode(is_array($datas['content']) ? $datas['content'] : []);
            if (isset($datas['id']) && PostTemplateModel::get($datas['id'])) {
                $tid = $datas['id'];
//                var_dump($datas);
                unset($datas['id']);
                unset($datas['create_time']);
                unset($datas['update_time']);
                $result = $postTempModel->save($datas, ['id' => $tid]);
            } else {
                $datas['create_time'] = strtotime('now');
                $datas['is_active'] = true;
                $datas['author'] = 'system';
                $datas['post_used'] = 0;
                $result = $postTempModel->save($datas);
            }

            $this->success('成功设置新的数据模板', '', $result);
        } catch (Exception $exception) {
            $this->error('增加新的数据模板失败', '', ['msg' => $exception->getMessage()]);
        }
    }
}
