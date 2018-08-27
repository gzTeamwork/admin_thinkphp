<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-24 0024
 * Time: 7:56
 */

namespace app\admin\apiHandler;

use app\admin\facade\QueryPageFacade;
use app\admin\facade\TranslateFacade;
use app\inforward\model\post\PostExtraModel;
use app\inforward\model\post\PostModel;
use app\inforward\model\post\PostTemplateModel;
use think\Exception;

trait PostApiHandler
{

    /**
     * 获取文章
     * @throws Exception
     * showdoc
     * @catalog 文章接口/通用文章接口
     * @title 通过id获取单个文章
     * @description 用于单篇文章内容,不包含文章模板数据
     * @method get
     * @url [hostname]/inforward/admin/api/do/api_post_get
     * @param id 必选 int 查询文章的id
     * @return ""
     * @return_param data array 文章内容
     * @number 99
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
     * showdoc
     * @catalog 文章接口/通用文章接口
     * @title 通过id获取单个文章详情
     * @description 用于单篇文章内容,包含文章模板数据
     * @method get
     * @url [hostname]/inforward/admin/api/do/api_post_get_detail
     * @param id 可选 string 文章id
     * @return ""
     * @return_param post array 对应id文章内容
     * @number 99
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
     * showdoc
     * @catalog 文章接口/通用文章接口
     * @title 获取多个文章
     * @description 用于获取多个文章,不包含文章模板数据
     * @method get
     * @url [hostname]/inforward/admin/api/do/api_posts_get
     * @param page 可选 string 分页页数
     * @param perPage 可选 string 分页每页项目数
     * @return ""
     * @return_param data array 文章列表
     * @number 99
     */
    public function api_posts_get($datas, $needReturn = false)
    {
        try {
            $postModel = (new PostModel());

            $postQueryDatas = $postModel->fieldsFilter($postModel->getTableFields(), $datas);
            $pageDatas = QueryPageFacade::getQueryPage($datas);

            $result = $postModel->where($postQueryDatas)->page($pageDatas['page'], $pageDatas['perPage'])->select();

            $result = $postModel->getResult($result);
            if ($needReturn) {
                return $result;
            } else {
                $this->success('成功获取文章列表', '', $result);
            }
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    /**
     * 简单列表
     * @param $datas
     * showdoc
     * @catalog 文章接口/通用文章接口
     * @title 获取多个文章列表
     * @description 获取多个文章列表,不包含文章模板数据
     * @method get
     * @url [hostname]/inforward/admin/api/do/api_posts_get_no_detail
     * @param page 可选 string 分页页数
     * @param perPage 可选 string 分页每页项目数
     * @return ""
     * @return_param data array 文章列表
     * @number 99
     */
    public function api_posts_get_no_detail($datas)
    {
        try {
            $postModel = (new PostModel());

            $postQueryDatas = $postModel->fieldsFilter($postModel->getTableFields(), $datas);
            $pageDatas = QueryPageFacade::getQueryPage($datas);
            $result = $postModel->where($postQueryDatas)->page($pageDatas['page'], $pageDatas['perPage'])->select();

            $successMsg = '成功获取文章列表';
            $this->success($successMsg, '', $result);
        } catch (Exception $exception) {
            $errorMsg = '';
            $this->error($errorMsg ?? $exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * @param $datas
     * showdoc
     * @catalog 文章接口/通用文章接口
     * @title 获取多个文章详情列表
     * @description 获取多个文章详情列表,包含文章模板数据
     * @method get
     * @url [hostname]/inforward/admin/api/do/api_posts_get_detail
     * @param page 可选 string 分页页数
     * @param perPage 可选 string 分页每页项目数
     * @return ""
     * @return_param data array 文章列表
     * @number 99
     */
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
     * @todo 重构写字楼单元内容数据结构,增加对应的建筑物和建筑物楼层设置
     * @return array|\PDOStatement|string|\think\Collection
     */
    public function api_posts_get_detail_list($datas, $needReturn = false)
    {
        try {

            $postFields = (new PostModel())->getTableFields();
            //  获取表单字段以内的查询参数
            $postQueryDatas = array_intersect_key($datas, array_flip($postFields));
            //  获取表单字段以外的查询参数
            $postExtraQueryDatas = array_diff_key($datas, array_flip($postFields));
            //  整合查询分页参数
            $pageDatas = QueryPageFacade::getQueryPage($datas);

            //  是否使用复合查询模型
            if (isset($postExtraQueryDatas['floor'])) {
                $postModel = PostModel::hasWhere('postExtra', ['name' => 'floor', 'value' => $datas['floor']])->where($postQueryDatas);
            } elseif (isset($postExtraQueryDatas['unit_house_type'])) {
                $postModel = PostModel::hasWhere('postExtra', ['name' => 'unit_house_type', 'value' => $datas['unit_house_type']])->where($postQueryDatas);
            } else {
                $postModel = (new PostModel())->with('postExtra')->where($postQueryDatas);
            }


            //  执行查询
            $result = $postModel->page($pageDatas['page'], $pageDatas['perPage'])->select();

            //  简繁处理
            $needTrans = isset($postExtraQueryDatas['needTrans']) && $postExtraQueryDatas['needTrans'] == true;
            foreach ($result as $key => $post) {

                //  简繁切换
                if ($needTrans) {
                    $result[$key]['title'] = TranslateFacade::c2t($post['title']);
                    $result[$key]['content'] = TranslateFacade::c2t($post['content']);
                }

                //  文章附加数据处理
                foreach ($post['post_extra'] as $kkey => $extra) {

//                    //  数据输出过滤
//                    if (array_key_exists($extra['name'], $postExtraQueryDatas) && $extra['value'] != $postExtraQueryDatas[$extra['name']]) {
//                        unset($result[$key]);
//                        break;
//                    }
                    //  数据类型转换
                    $value = $needTrans ? TranslateFacade::c2t($extra['value']) : $extra['value'];
                    switch ($extra['type']) {
                        case 'boolean':
                            $value = $value ? true : false;
                            break;
                        case 'datetime':
                            $value = date('Y年m月d日', strtotime($value));
                            break;
//                        case 'array':
//                            $value = explode(',', $value);
                    }

                    //  赋值数据
                    $result[$key][$extra['name']] = $value;
                }

                //  去掉附加源数据
                unset($post['post_extra']);
            }
            if ($needReturn) {
                return $result;
            } else {
                $this->success('获取文章详情数据成功', '', $result);
            }
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
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
                $datas['is_active'] = 1;
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
     * 文章模板api
     * post template
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

    /**
     * 保存文章模板
     * @param $datas
     */
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
