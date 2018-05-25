<?php
namespace app\inforward\controller;

use \think\Controller;

//  二维码接口控制器
class QrcodeApi extends \think\Controller
{
    public function index()
    {
        echo "欢迎访问盈富永泰集团二维码资产管理平台~";
    }
    public function build_qr_code($content = '123')
    {
        
    }
}
