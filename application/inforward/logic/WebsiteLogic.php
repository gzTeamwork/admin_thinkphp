<?php

namespace \app\inforward\logic;

class WebsiteLogic{

    /**
     *
     * @param null $code
     * @return \think\response\Json
     */
    public function code_valid($code =null){
        try {
            if (is_null($code)) {
                throw new HttpRequestException("Can't found 'code' query param,", 404);
            }
        } catch (Exception $e) {
            return json(['err_msg' => $e->getMessage(), 'code' => $e->getCode()]);
        }
    }

    public function get_code(){

    }
}