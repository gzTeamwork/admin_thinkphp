<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/8/2
 * Time: 上午10:06
 */

namespace app\inforward\apiHandler;

use app\admin\apiHandler\PostApiHandler as AdminPostAPi;

trait PostApiHandler
{
    use AdminPostAPi;

    /**
     * 查询办公室
     * @param $datas
     */
    public function api_posts_get_office($datas)
    {
        $datas['kind'] = 'office_unit';
        return $this->api_posts_get_detail_list($datas);
    }

    /**
     * 查询公寓
     * @param $datas
     */
    public function api_posts_get_department($datas)
    {
        $datas['kind'] = 'yu_department';
        return $this->api_posts_get_detail_list($datas);
    }

    /**
     * 查询文章
     * @param $datas
     */
    public function api_posts_get_recruit($datas)
    {
        $data['kind'] = 'recruit';
        return $this->api_posts_get_detail_list($datas);
    }

}