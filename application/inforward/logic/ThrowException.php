<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/1
 * Time: 下午2:28
 */

namespace app\inforward\logic;

/**
 * Class ThrowException - 自定义异常处理类
 * @package app\infoward\logic
 */
trait ThrowException
{
    public static $error_code_table = [
        400 => 'Some thing has been error !!',
        401 => 'The data query accepts the wrong parameters',
    ];

    public static function throw_error($code = 400, $message = null)
    {
        $error_response = [
            'code' => $code,
            'message' => $message || self::$error_code_table[$code] || self::$error_code_table[400],
            'status' => 'error',
        ];
        return json($error_response, $code);
    }
}
