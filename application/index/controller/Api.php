<?php
namespace app\index\controller;

use think\Facade\Request;

class Api
{
    private $_appKeys = ["oa_attendance" => "1234567"];

    protected $request;

    public function index()
    {
        return json_encode("yeah~");
    }
    /**
     * 验证申请appToken
     *
     * @param [type] $token
     * @return void
     */
    private function _vaid_appToken($token)
    {
        if (in_array($token, $this->_appKeys)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Apps通过get_token换取认证app_token
     *
     * @return void
     */
    public function get_token()
    {
        header("Access-Control-Allow-Origin: *");

        //  apps申请请求token

        $token = Request::param("appToken");

        return json_encode(isset($this->_appKeys[$token]) ? $this->_appKeys[$token] : null);
    }
    public function get_restByWorker()
    {
        header("Access-Control-Allow-Origin: *");

        //  获取员工排休记录

        $workerId = Request::param("workerId");
        $appToken = Request::param("appToken");

        if ($this->_vaid_appToken($appToken)) {
            $record = [['date' => '2018/4/18', 'workId' => $workerId]];
            return json($record);
        }
    }
}
