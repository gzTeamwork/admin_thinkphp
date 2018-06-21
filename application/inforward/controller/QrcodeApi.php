<?php

namespace app\inforward\controller;

use app\inforward\middleware\base\mwControllerBase;
use app\inforward\middleware\qrcode\mwQrcode;
use think\App;
use think\Controller;
use think\Exception;

header("Access-Control-Allow-Origin:*");

class QrcodeApi extends Controller
{
    use mwControllerBase;
    use mwQrcode;

    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->apiList = ['get_qrcode'];
    }

    public function index()
    {
        echo '本模块是用于二维码资产管理的';
    }

    /**
     * get_qrcode
     * 获取单个二维码
     * @return \think\response\Json
     */
    public function get_qrcode()
    {
        try {
            $this->validApi(__FUNCTION__);
            $unionId = $this->getParam('union_id', null, true);
            $qrcode = $this->getItem($unionId);
            return json($qrcode);
        } catch (Exception $exception) {
            return json($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * get_qrcode_items
     * 获取多个二维码项目
     * @return \think\response\Json
     */
    public function get_qrcode_items()
    {
        try {
            $this->validApi(__FUNCTION__);
            $number = $this->getParam('num', 20);
            $qrCodes = $this->getItems($number);
            return json($qrCodes);
        } catch (Exception $exception) {
            return json($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * set_batch_qrcodes
     * 批量增加二维码
     * @return \think\response\Json
     */
    public function set_batch_qrcodes()
    {
        try {
            $this->validApi(__FUNCTION__);
            $number = $this->getParam('num', 20, true);
            $items = [];
            for ($i = 0; $i < $number; $i++) {
                $dateTime = date('Y-m-d h:i:s', time() . $i);
                $items[] = ['unionid' => md5('inforward' . time() . $i), 'create_time' => $dateTime, 'update_time' => $dateTime, 'group' => 'test', 'mode' => 'qrcode', 'author' => '梓豪'];
                // var_dump($item);
            }
            $this->insertItems($items);
        } catch (Exception $exception) {
            return json($exception->getMessage(), $exception->getCode());
        }
    }
}
