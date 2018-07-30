<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/19
 * Time: 上午9:01
 */

namespace app\inforward\middleware\base;

use Monolog\Handler\ElasticSearchHandler;
use PhpParser\Node\Expr\Array_;
use think\Collection;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\Exception;

trait mwModelBase
{
    use mwModelGetters;

    /**
     * 字段空检查
     * @param $datas
     * @return mixed
     * @throws Exception
     */
    static public function fieldsNotNull(&$datas, $validFields = null)
    {

        $validDatas = is_null($validFields) ? $datas : array_intersect_key($datas, array_flip($validFields));
        $index = array_search('', $validDatas);
        if (false !== $index) throw new Exception($index . '字段不能为空白');
        return $datas;
    }

    /**
     * 需要有的字段
     * @param array $needles
     * @param array $where
     * @return array
     */
    static public
    function fieldsNeed(array $needles = [], array $where = [])
    {
        return empty($needles) ? $where : array_merge($where, $needles);
    }

    /**
     * 过滤查询字段
     * @param $fields
     * @param $datas
     * @return array
     */
    static public
    function fieldsFilter($fields, array &$datas)
    {
        return array_intersect_key($datas, array_flip($fields));
    }

    /**
     * 根据数据表字段过滤查询字段
     * @param $datas
     * @return array
     */
    public function fieldsFilterByDataTable(&$datas)
    {
        return $this->fieldsFilter($this->getTableFields(), $datas);
    }

    /**
     * 预处理获取数据结果
     * @param $result
     * @param bool $strict 严格模式->空值抛出错误
     * @param string $errorMsg
     * @return null
     * @throws ModelNotFoundException
     */
    public
    function getResult(Collection &$result, $strict = true, $errorMsg = '查找结果为空')
    {
        if (empty($result->toArray()) && $strict) {
            throw new ModelNotFoundException($errorMsg);
        }
        return $result->toArray();
    }

    /**
     * 以列值为数组key返回结果
     * @param $result
     * @param $colName
     * @return array
     * @throws ModelNotFoundException
     */
    public
    function getResultByCol(Collection &$result, $colName)
    {
        $res = $this->getResult($result, false);
        return array_combine(array_column($res, $colName), $res);
    }


}