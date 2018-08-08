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

trait PostApiHandler
{
    use AdminPostAPi;

    /**
     * 查询办公室
     * @param $datas
     * @return array|\PDOStatement|string|Collection
     */
    public function api_posts_get_office($datas)
    {
        $datas['kind'] = 'office_unit';
        return $this->api_posts_get_detail_list($datas);
    }

    /**
     * 查询公寓 - 已经租了的
     * @param $datas
     */
    public function api_posts_get_apartment($datas)
    {
        $datas['kind'] = 'yu_apartment';
        $datas['is_sold'] = false;
        $result = $this->api_posts_get_detail_list($datas, true);
        $posts = $result->toArray();

        foreach ($posts as $key => $item) {
            if (isset($item['is_sold']) && false === $item['is_sold']) {
            } else {
                unset($posts[$key]);
            }
        }

        $this->success('获取出租了的公寓详情数据成功', '', $posts);
    }

    /**
     * 查询公寓 - 还没有租的
     * @param $datas
     */
    public function api_posts_get_apartment_leased($datas)
    {
        $datas['kind'] = 'yu_apartment';
        $datas['is_sold'] = true;
        $result = $this->api_posts_get_detail_list($datas, true);
        $posts = $result->toArray();

        foreach ($posts as $key => $item) {
            if (isset($item['is_sold']) && true === $item['is_sold']) {
            } else {
                unset($posts[$key]);
            }
        }

        $this->success('获取没有出租的公寓详情数据成功', '', $posts);
    }

    /**
     * 查询自家招聘
     * @param $datas
     * @return array|\PDOStatement|string|Collection
     */
    public function api_posts_get_recruit($datas)
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
     */

    public function api_posts_get_recruit_agency($datas)
    {
        $datas['kind'] = 'recruit_agency';
        return $this->api_posts_get_detail_list($datas);
    }

}