<?php

namespace app\inforward\logic;

use think\Exception;

trait BaseController
{

    /**
     * getParam
     * 对传参进行预处理
     *
     * @param [type] $params
     * @param array $must
     * @param array $filter
     * @return void
     */
    public function getParam($params = null, array $must = [], array $filter = [])
    {
        try {
            if (is_array($params) && count($params) < 1) {
                ThrowException::throw_error(401);
            }
            if (is_array($must) && count($must) > 0) {
                foreach ($must as $k) {
                    isset($params[$k]) ?: ThrowException::throw_error(401, 'Can not find[' . $k . '] param');
                }
            }

            if (is_array($filter) && count($filter) > 0) {
                foreach ($filter as $k) {
                    if ($params[$k]) {
                        unset($params[$k]);
                    }
                }
            }

            return $params;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function validParams($params, $rules)
    {
        foreach ($params as $key => $param) {
            if (isset($rules[$key])) {

            }
        }
    }

    public function validParam($value, $rule)
    {
        switch ($rule['type']) {

        }
    }

    //  返回标准化接口数据
    private function _standard_response($response, $resCode = 200)
    {
        return json($response)->code($resCode);
    }
}
