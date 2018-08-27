<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/8/2
 * Time: 上午10:06
 */

namespace app\inforward\apiHandler;

use app\admin\apiHandler\PostApiHandler as AdminPostAPi;
use think\Collection;
use think\Exception;

trait PostApiHandler
{
    use AdminPostAPi;

    public $units_house_types = [
        0 => null,
        1 => '三房两厅',
        2 => '两房两厅',
        3 => '一房一厅',
        4 => '整租',
        5 => '合租',
    ];

    /**
     * 查询办公室
     * @param $datas
     * @return array|\PDOStatement|string|Collection
     * showdoc
     * @catalog 前端接口/文章接口
     * @title 获取商业写字楼文章
     * @description 获取多个商业写字楼文章
     * @method get
     * @url [hostname]/inforward/admin/api/do/api_posts_get_office
     * @param floor 必选 string 楼层筛选
     * @param page 可选 string 页码
     * @param perPage 可选 string 每页项目数
     * @return { array }
     * @number 99
     */
    public function api_posts_get_office($datas)
    {
        try {
            $datas['kind'] = 'office_unit';
            $result = $this->api_posts_get_detail_list($datas, true);
            $successMsg = '';
            $this->success($successMsg, '', $result);
        } catch (Exception $exception) {
            $errorMsg = '';
            $this->error($errorMsg ?? $exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * 查询公寓 - 已经租了的
     * @param $datas
     * showdoc
     * @catalog 前端接口/文章接口
     * @title 获取公寓文章
     * @description 获取多个公寓文章
     * @method get
     * @url [hostname]/inforward/admin/api/do/api_posts_get_apartment
     * @param floor 必选 string 楼层筛选
     * @param unit_house_type 必选 int 单元盘型筛选
     * @param page 可选 string 页码
     * @param perPage 可选 string 每页项目数
     * @return { array }
     * @return_param groupid int 用户组id
     * @return_param name string 用户昵称
     * @remark 这里是备注信息
     * @number 99
     */

    public function api_posts_get_apartment($datas)
    {
        $datas['kind'] = 'yu_apartment';
        $datas['is_sold'] = true;

        //  筛选公寓户型
        if (isset($datas['unit_house_type'])) {
            if (isset($this->units_house_types[$datas['unit_house_type']])) {
                $datas['unit_house_type'] = $this->units_house_types[$datas['unit_house_type']];
            } else {
                unset($datas['unit_house_type']);
            }
        }

        $result = $this->api_posts_get_detail_list($datas, true);
        $posts = $result->toArray();

        foreach ($posts as $key => $item) {
            if (isset($item['is_sold']) && true === $item['is_sold']) {
            } else {
                unset($posts[$key]);
            }

            //  过滤对应户型
            if (isset($datas['unit_house_type']) && isset($item['unit_house_type'])) {
                if ($item['unit_house_type'] != $datas['unit_house_type']
                ) {
                    unset($posts[$key]);
                }
            }
        }

        $this->success('获取出租了的公寓详情数据成功', '', $posts);
    }

    /**
     * 查询公寓 - 还没有租的
     * @param $datas
     * showdoc
     * @return void {"code":1,"msg":"获取没有出租的公寓详情数据成功","data":[{"id":26,"title":"珠光御景A1-1602","content":"<p><\/p>\n<p>本单元处于建筑群高层区，采光良好，室内设施齐备&hellip;&hellip;<\/p>","author":null,"category":0,"create_time":"2018-07-31 09:53:12","update_time":"2018-08-08 21:53:19","thumb":"http:\/\/inforward.localhost.com\/static\/uploads\/imgs\/20180808\/886eb4ae15dd04c3e2150d55b64604aa.JPG","kind":"yu_apartment","is_active":null,"unit_position":"珠光御景二期","unit_number":"A1-1602","unit_house_type":"两房两厅","unit_house_area":"66","unit_rent_price":"7000","unit_mr_fee":"1.9元\/方","unit_ele_fee":"0.61\/度","unit_water_fee":"2.93\/吨","unit_rent_type":"整租","unit_order_price":"8800","unit_order_date":"2018年09月30日","unit_order_discount":"0.98","province":"广东","city":"广州","region":"天河","zone":"珠江新城","address":"广州市天河区谭村珠光新城御景二期","unit_traffic":"5号线谭村c出口","tags":"西北,精装修,拎包即可","floor":"16","is_sold":true},{"id":27,"title":"珠光御景A1-1707A","content":"","author":null,"category":44,"create_time":"2018-07-31 14:30:03","update_time":"2018-08-08 21:39:03","thumb":"http:\/\/inforward.localhost.com\/static\/uploads\/imgs\/20180808\/7ff314dfd6c4a26920e8546128aedfba.JPG","kind":"yu_apartment","is_active":null,"unit_position":"珠光御景住宅项目","unit_number":"A1-1707A","unit_house_type":"三房两厅","unit_house_area":"78","unit_rent_price":"7800","unit_mr_fee":"1.9元\/方","unit_ele_fee":"0.61\/度","unit_water_fee":"2.93\/吨","unit_rent_type":"整租","unit_order_price":"8800","unit_order_date":"2018年12月30日","unit_order_discount":"0.98","province":"广东","city":"广州","region":"天河","zone":"潭村","address":"广州市天河区谭村珠光新城御景二期","unit_traffic":"5号线谭村c出口","tags":"西北,精装修,拎包即可","floor":"17","is_sold":true}],"url":"","wait":3},{"id":27,"title":"珠光御景A1-1707A","content":"","author":null,"category":44,"create_time":"2018-07-31 14:30:03","update_time":"2018-08-08 21:39:03","thumb":"http:\/\/inforward.localhost.com\/static\/uploads\/imgs\/20180808\/7ff314dfd6c4a26920e8546128aedfba.JPG","kind":"yu_apartment","is_active":null,"unit_position":"珠光御景住宅项目","unit_number":"A1-1707A","unit_house_type":"三房两厅","unit_house_area":"78","unit_rent_price":"7800","unit_mr_fee":"1.9元\/方","unit_ele_fee":"0.61\/度","unit_water_fee":"2.93\/吨","unit_rent_type":"整租","unit_order_price":"8800","unit_order_date":"2018年12月30日","unit_order_discount":"0.98","province":"广东","city":"广州","region":"天河","zone":"潭村","address":"广州市天河区谭村珠光新城御景二期","unit_traffic":"5号线谭村c出口","tags":"西北,精装修,拎包即可","floor":"17","is_sold":true}],"url":"","wait":3}
     * @catalog 前端接口/文章接口
     * @title 已租公寓
     * @description 获取已经出租了的公寓,为了承接预约接盘工作
     * @method get
     * @url [hostname]/inforward/admin/api/do/api_posts_get_apartment_leased
     * @return_param groupid int 用户组id
     * @return_param name string 用户昵称
     * @remark 这里是备注信息
     * @number 99
     */
    public function api_posts_get_apartment_leased($datas)
    {
        $datas['kind'] = 'yu_apartment';
        $datas['is_sold'] = false;

        //  筛选公寓户型
        if (isset($datas['unit_house_type'])) {
            if (isset($this->units_house_types[$datas['unit_house_type']])) {
                $datas['unit_house_type'] = $this->units_house_types[$datas['unit_house_type']];
            } else {
                unset($datas['unit_house_type']);
            }
        }

        $result = $this->api_posts_get_detail_list($datas, true);
        $posts = $result->toArray();

        foreach ($posts as $key => $item) {

//            if (isset($item['is_sold']) && false === $item['is_sold']) {
//            } else {
//                unset($posts[$key]);
//            }
            //  过滤对应户型
//            if (isset($datas['unit_house_type']) && isset($item['unit_house_type'])) {
//                if ($item['unit_house_type'] != $datas['unit_house_type']
//                ) {
//                    unset($posts[$key]);
//                }
//            }
        }

        $this->success('获取没有出租的公寓详情数据成功', '', $posts);
    }

    /**
     * 查询自家招聘
     * @param $datas
     * @return array|\PDOStatement|string|Collection
     * showdoc
     * @catalog 前端接口/文章接口
     * @title 招聘文章接口
     * @description 用于获取招聘文章列表
     * @method get
     * @url [hostname]/inforward/admin/api/do/api_posts_get_recruit
     * @param company 可选 string 筛选招聘的公司内容
     * @param page 可选 string 页码
     * @param perPage 可选 string 每页项目数
     * @return {array}
     * @number 99
     */
    public
    function api_posts_get_recruit($datas)
    {
        $datas['kind'] = 'recruit';
        $result = $this->api_posts_get_detail_list($datas, true);
        $posts = $result->toArray();

        if (isset($datas['company'])) {
            foreach ($posts as $key => $post) {
                if (isset($post['company']) && $post['company'] == $datas['company']) {
                } else {
                    unset($posts[$key]);
                }
            }
        }

        $this->success('成功获取盈富永泰招聘岗位信息', '', $posts);

    }

    /**
     * 查询代理招聘
     * @param $datas
     * @return array|\PDOStatement|string|Collection
     * showdoc
     * @catalog 前端接口/文章接口
     * @title 获取代理招聘接口
     * @description 获取代理招聘文章接口
     * @method get
     * @url [hostname]/inforward/admin/api/do/api_posts_get_recruit_agency
     * @param page 可选 string 页码
     * @param perPage 可选 string 每页项目数
     * @return { array }
     * @number 99
     */

    public
    function api_posts_get_recruit_agency($datas)
    {
        $datas['kind'] = 'recruit_agency';
        return $this->api_posts_get_detail_list($datas);
    }

}