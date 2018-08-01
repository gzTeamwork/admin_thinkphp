<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/7/31
 * Time: 下午2:01
 */

namespace app\admin\middleware;

class mwQueryPage
{
    public $queryPage = [
        'page' => 1,
        'perPage' => 10,
        'maxPaged' => 1,
    ];


    /**
     * @param $datas
     * @return array
     */
    function getQueryPage($datas)
    {
        return array_intersect_key(array_merge($this->queryPage, $datas), $this->queryPage);
    }

}