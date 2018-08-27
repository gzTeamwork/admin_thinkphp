<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/8/8
 * Time: 下午2:59
 */

namespace app\inforward\apiHandler;

use app\admin\facade\QueryPageFacade;
use app\inforward\model\DynamicModel;
use think\Exception;

trait  DynamicApiHandler
{

    /**
     * 接收访客公益留言
     * @param $datas
     * showdoc
     * @return {"code":1,"msg":"成功获取评论","data":true,"url":"","wait":3}
     * @catalog 前端接口/留言/公益留言
     * @title 提交用户公益留言
     * @description 用于接收官网提交的
     * @method post
     * @url [hostname]/inforward/admin/api/do/api_accept_benefit_dynamics
     * @return_param code 操作成功返回1
     * @number 99
     */
    public function api_accept_benefit_dynamics($datas)
    {
        try {
            if (isset($datas['id']))
                unset($datas['id']);
            $datas['group'] = 'benefit';
            $datas['name'] = isset($datas['name']) ? $datas['name'] : '游客';
            $dynamicModel = new DynamicModel();
            $result = $dynamicModel->allowField(true)->save($datas);

            $successMsg = '成功获取评论';
            $this->success($successMsg, '', $result);

        } catch (Exception $exception) {
            $errorMsg = '';
            $this->error($errorMsg ?? $exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * @param $datas
     * showdoc
     * @return {"code":1,"msg":"成功获取留言信息","data":[{"id":1,"name":"热心市民","content":"我要捐款","create_time":"2018-08-08 15:12:24","tel":"13828411223","user_token":null,"pid":null,"group":"benefit"}],"url":"","wait":3}
     * @catalog 前端接口/留言
     * @title 获取最近留言
     * @description 用于获取最近提交的用户公益留言
     * @method get
     * @url [hostname]/inforward/admin/api/do/api_get_dynamics
     * @remark 这里是备注信息
     * @number 99
     */
    public function api_get_dynamics($datas)
    {
        try {
            $dynamicModel = new DynamicModel();
            $pageDatas = QueryPageFacade::getQueryPage($datas);
            $whereData = $dynamicModel->fieldsFilterByDataTable($datas);
            $result = $dynamicModel->where($whereData)->order('create_time', 'asc')->page($pageDatas['page'], $pageDatas['perPage'])->select();

            $successMsg = '成功获取留言信息';
            $this->success($successMsg, '', $result);

        } catch (Exception $exception) {
            $errorMsg = '获取留言信息失败';
            $this->error($errorMsg ?? $exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * @param $datas
     * showdoc
     * @return {"code":1,"msg":"成功获取留言信息","data":[{"id":1,"name":"热心市民","content":"我要捐款","create_time":"2018-08-08 15:12:24","tel":"13828411223","user_token":null,"pid":null,"group":"benefit"}],"url":"","wait":3}
     * @catalog 前端接口/留言/公益留言
     * @title 用于获取公益留言
     * @description 用户登录的接口
     * @method get
     * @url [hostname]/inforward/admin/api/do/api_get_benefit_dynamic
     * @remark 这里是备注信息
     * @number 99
     */
    public function api_get_benefit_dynamic($datas)
    {
        $datas['group'] = 'benefit';
        return $this->api_get_dynamics($datas);
    }
}