<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/7/31
 * Time: 下午2:01
 */

namespace app\inforward\middleware;

use think\facade\Request;
use think\Model;

trait mwQueryPage
{
    static public $queryPage = [
        'page' => 1,
        'perPage' => 10,
        'maxPaged' => 1,
    ];


    static function getQueryPage($datas)
    {
        return array_intersect_key(array_merge(self::$queryPage, $datas),self::$queryPage );
    }

}